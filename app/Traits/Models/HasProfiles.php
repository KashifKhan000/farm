<?php

namespace App\Traits\Models;

use App\Models\Profile;

trait HasProfiles
{
    /**
     * @var array
     */
	protected $cached_profiles;

    /**
     * @var array
     */
	protected $cached_entries;

    /**
     * @param  string  $name
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function profile(string $name = 'primary')
    {
        return $this->morphOne(Profile::class, 'owner')->whereName($name);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function profiles()
    {
        return $this->morphMany(Profile::class, 'owner');
    }

    /**
     * @return \App\Models\Profile
     */
    protected function getCachedProfile(string $name)
    {
        if (!isset($this->cached_profiles)) {
			$this->cached_profiles = [ $name => $this->profile($name)->first() ];
		} else if (!array_key_exists($name, $this->cached_profiles)) {
			$this->cached_profiles[$name] = $this->profile($name)->first();
		}

        if (!is_null($this->cached_profiles[$name])) {
            $this->cached_entries[$name] = $this->cached_profiles[$name]->entries->all();
        }

		return $this->cached_profiles[$name];
    }

    /**
     * @return mixed
     */
    protected function getCachedProfileValue(string $profile_name, string $attribute_name)
    {
        if (!isset($this->cached_profiles) || !array_key_exists($profile_name, $this->cached_profiles)) {
            $this->getCachedProfile($profile_name);
        }

        if (is_null($this->cached_profiles[$profile_name])) {
            return null;
        }

        return $this->cached_entries[$profile_name][$attribute_name]['value'] ?? null;
    }
}
