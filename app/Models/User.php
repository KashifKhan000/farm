<?php

namespace App\Models;

use App\Events\Api\v1\User\UserCreated;
use App\Traits\Models\{ HasAddresses, HasEnabledState, HasFullName, HasProfiles, HasUserAbilities, HasMeta, HasAppendsOverrides };

use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Illuminate\Support\Facades\DB;

class User extends BaseUser
{
    use Billable, Notifiable, HasApiTokens, HasAddresses, HasEnabledState, HasFullName, HasProfiles, HasUserAbilities, HasMeta, HasAppendsOverrides;

    protected $appends = [
        'email',
        'is_identified',
        'initials',
    ];

    protected $fillable = [
        'account_id',
        'first_name',
        'middle_name',
        'last_name',
        'superhero_name',
        'slug',
        'sex',
        'measurements_unit',
        'timezone',
        'primary_phone_number',
        'secondary_phone_number',
        'is_enabled'
    ];

    protected $with = [

    ];

    protected $dispatchesEvents = [
        'created' => UserCreated::class
    ];

    public function stripeEmail()
    {
        return $this->email;
    }

    public function stripeAddress()
    {
        $address = $this->address;

        if (!empty($address)) {
            $data = [
                'city' => $address->city,
                'country' => $address->country,
                'line1' => $address->line1,
                'line2' => $address->line2,
                'postal_code' => $address->postal_code,
                'state' => $address->province,
            ];
            return $data;
        }
    }

    public function stripeName()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * The daily app usages/logins for a user
     *
     * @param  string  $name
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function app_usages()
    {
        return $this->hasMany(AppUsage::class);
    }

    /**
     * The user's avatar, stored in a morphable Image model and identified via the name 'avatar'
     *
     * @param  string  $name
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function avatar(string $name = 'avatar')
    {
        return $this->morphOne(Image::class, 'owner')->whereName($name);
    }

    /**
     * A user's account, which relates to the current operational status
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * A user's badges which are awarded based on a series of qualifications. Typically awarded via event listeners
     * Reference the App\Traits\Observers\Api\v1\Badges folder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function badges()
    {
        return $this->belongsToMany(Badge::class)
            ->using(BadgeUser::class);
    }

    /**
     * Get the certifications for a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }

    /**
     * Get's the user's cylinder assets defined in the the "Cylinder Management" areas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cylinder_assets()
    {
        return $this->hasMany(CylinderAsset::class);
    }

    /**
     * Get the user's assigned company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company()
    {
        return $this->hasOne(Company::class);
    }

    /**
     * Get the contacts for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contacts()
    {
        return $this->belongsToMany(Contact::class);
    }

    /**
     * Get the goals for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    /**
     * Get this user's 'identities'.Often  one defined as 'primary' with the type 'email'
     * Can however be social media profiles with unique identifiers, usually thorugh Laravel Socialite
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function identities()
    {
        return $this->hasMany(Identity::class);
    }

    /**
     * Get this user's privileges/permission classes that control Policy levels.
     * Often none returned unless Root or Admin, as normal users typically do not have one defined
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function privileges()
    {
        return $this->belongsToMany(Privilege::class)
                    ->using(PrivilegeUser::class);
    }

    /**
     * Get the user's points
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function points()
    {
        return $this->belongsToMany(Point::class);
    }

    /**
     * Return the user's total points
     *
     * @return mixed
     */
    public function getTotalPointsAttribute()
    {
        return $this->points()->sum('quantity');
    }

    /**
     * Get the recovery equipment for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recovery_equipment()
    {
        return $this->hasMany(RecoveryEquipment::class);
    }

    /**
     * Get this user's 'secrets', more often than not a password, but can be an OAuth identifier as well
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function secrets()
    {
        return $this->hasMany(Secret::class);
    }

    /**
     * Get this user's created service events
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function service_events()
    {
        return $this->hasMany(ServiceEvent::class);
    }

    /**
     * Retreive the primary email address for this user.
     *
     * @return string|null
     */
    public function getEmailAttribute()
    {
        if (is_null($this->identified_at)) {
            return null;
        }

        return $this->identities()
                    ->where('type', 'email')
                    ->where('name', 'primary')
                    ->whereNotNull('verified_at')
                    ->first()
                    ->value ?? null;
    }

    /**
     * Retreive the primary email address for this user that has not yet been verified.
     *
     * @return string|null
     */
    public function getUnverifiedEmailAttribute()
    {
        return $this->identities()
                    ->where('type', 'email')
                    ->where('name', 'primary')
                    ->whereNull('verified_at')
                    ->first()
                    ->value ?? null;
    }

    /**
     * Retreive the primary mobile number for this user.
     *
     * @return string|null
     */
    public function getMobileAttribute()
    {
        $predicate = [
            'type' => 'mobile',
            'name' => 'primary'
        ];

        return $this->identities()
                    ->where($predicate)
                    ->first()
                    ->value ?? null;
    }

    /**
     * Return whether or not this user has been verified/identified
     *
     * @return bool
     */
    public function getIsIdentifiedAttribute()
    {
        return $this->identities()
                    ->whereNotNull('verified_at')
                    ->exists();
    }

    /**
     * Get the total number of identiies verified
     *
     * @return int
     */
    public function getTotalIdentitiesVerifiedAttribute()
    {
        return $this->identities()
                    ->whereNotNull('verified_at')
                    ->count();
    }

    /**
     * Return the number of OCR scans a user has
     *
     * @return integer
     */
    public function getOcrScansAttribute()
    {
        $ocrScans = $this->meta()->whereName('ocr_scans')->first();
        if ($ocrScans) {
            return $ocrScans->value;
        }
    }

    /**
     * Return if the user has dark mode enabled
     *
     * @return mixed
     */
    public function getIsDarkModeEnabledAttribute()
    {
        return $this->getCachedProfileValue('primary', 'is_dark_mode_enabled');
    }

    /**
     * Return the user's avatar overlay/frame
     *
     * @return mixed
     */
    public function getAvatarOverlayAttribute()
    {
        return $this->getCachedProfileValue('primary', 'avatar_overlay');
    }

    /**
     * Return the user's "Public Badges" privacy setting
     *
     * @return mixed
     */
    public function getIsBadgesPublicAttribute()
    {
        return $this->getCachedProfileValue('privacy', 'is_badges_public');
    }

    /**
     * Return the user's "Public Certifications" privacy setting
     *
     * @return mixed
     */
    public function getIsCertificationsPublicAttribute()
    {
        return $this->getCachedProfileValue('privacy', 'is_certifications_public');
    }

    /**
     * Return the user's "Public Points" privacy setting
     *
     * @return mixed
     */
    public function getIsPointsPublicAttribute()
    {
        return $this->getCachedProfileValue('privacy', 'is_points_public');
    }

    /**
     * Return the first letter of user's first and last names
     *
     * @return string
     */
    public function getInitialsAttribute()
    {
        return ($this->first_name[0] ?? '') . ($this->last_name[0] ?? '');
    }

    /**
     * Return the user's public profile privacy setting
     *
     * @return mixed
     */
    public function getIsProfilePublicAttribute()
    {
        return $this->getCachedProfileValue('privacy', 'is_profile_public');
    }

    /**
     * Retrieves the streak of consecutive logins for a given user
     *
     * @return integer
     */
    public function appUsageStreak()
    {
        $query = DB::raw("
            SELECT * FROM (
                SELECT created_at,
                @streak := @streak+1 streak,
                datediff(curdate(),created_at) diff
                FROM app_usages
                CROSS JOIN (SELECT @streak := -1) t1
                WHERE user_id = 1
                AND created_at <= curdate()
                ORDER BY created_at DESC
                ) t1 where streak = diff
            ORDER BY streak DESC LIMIT 1
        ");

        $appUsages = DB::select($query, [
            "user_id" => $this->id,
        ]);

        if (!empty($appUsages)) {
            return $appUsages[0]->streak;
        } else return null;
    }
}

