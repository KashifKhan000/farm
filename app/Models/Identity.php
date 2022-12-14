<?php

namespace App\Models;

use App\Events\Api\v1\Identity\IdentityCreated;
use App\Exceptions\Api\v1\Identity\{ AlreadyVerified, ExpiredVerificationCode, InvalidVerificationCode, MissingVerificationCode, NullVerification };

use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'value'
    ];

    protected $casts = [
        'verified_at' => 'datetime'
    ];

    protected $dispatchesEvents = [
        'created' => IdentityCreated::class
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function oauth_token()
    {
        return $this->hasOne(OAuthAccessToken::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function recovery()
    {
        return $this->hasOne(Recovery::class)->orderBy('id', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function verification()
    {
        return $this->hasOne(Verification::class)->orderBy('id', 'desc');
    }

    /**
     * @return bool
     */
    public function attemptVerify(array $fields)
    {
        if ($this->is_verified) {
            throw new AlreadyVerified;
        } else if (!isset($fields['type']) || !isset($fields['value'])) {
            throw new MissingVerificationCode;
        } else if (is_null($this->verification)) {
            throw new NullVerification;
        }

        call_user_func([ $this, "attemptVerifyBy$fields[type]" ], $fields['value']);

        // It's possible this identity is replacing an existing one (i.e. the
        // user is changing their email address) so delete any already-verified
        // identities with a matching name.

        self::where('user_id', $this->user_id)
            ->where('name', $this->name)
            ->whereNotNull('verified_at')
            ->delete();

        return $this->forceFill([ 'verified_at' => now() ])->save();
    }

    /**
     * @return void
     */
    protected function attemptVerifyByCode($code)
    {
        if ($this->verification->code !== hash('sha256', str_replace('-', '', $code))) {
            throw new InvalidVerificationCode;
        } else if ($this->verification->created_at->diffInMinutes(now()) > config('croft.verification.ttl')) {
            throw new ExpiredVerificationCode;
        }
    }

    /**
     * @return void
     */
    protected function attemptVerifyByToken($token)
    {
        if (($this->oauth_token->value ?? null) !== $token) {
            throw new InvalidVerificationCode;
        }
    }

    /**
     * @return \App\Models\User|null
     */
    public function attemptRecover(array $fields)
    {
        if (($this->recovery->code ?? null) !== hash('sha256', str_replace('-', '', $fields['code']))) {
            throw new InvalidVerificationCode;
        }

        $now = now();

        if ($this->recovery->created_at->diffInMinutes($now) > config('croft.recovery.ttl')) {
            throw new ExpiredVerificationCode;
        }

        $this->recovery->forceFill([ 'verified_at' => $now ])->save();

        $secret_attributes = [
            'user_id' => $this->user_id,
            'type' => 'password',
        ];

        if ($existing_secret = Secret::where($secret_attributes)->first()) {
            $existing_secret->delete();
        }

        Secret::create([
            'user_id' => $this->user_id,
            'type' => 'password',
            'value' => $fields['password'],
        ]);

        return $this->recovery->identity->user ?? null;
    }

    /**
     * @return \App\Models\User|null
     */
    public function attemptChangePassword(array $fields)
    {
        $secret_attributes = [
            'user_id' => $this->user_id,
            'type' => 'password',
        ];

        if ($existing_secret = Secret::where($secret_attributes)->first()) {
            $existing_secret->delete();
        }

        Secret::create([
            'user_id' => $this->user_id,
            'type' => 'password',
            'value' => $fields['password'],
        ]);

        return $this->user;
    }

    /**
     * @return bool
     */
    public function getIsVerifiedAttribute()
    {
        return (bool) $this->verified_at;
    }

    /**
     * @return void
     */
    public function setVerifiedAtAttribute($value)
    {
        if (is_null($this->verified_at)) {
            $this->attributes['verified_at'] = $value;
        }
    }

    /**
     * @return \App\Models\Identity|null
     */
    static public function findByRequest($request)
    {
        if ($request->has('identity_id')) {
            return self::find($request->input('identity_id'));
        }

        $type = $request->input('type');
        $value = $request->input('value');

        return self::where(compact('type', 'value'))->first();
    }
}
