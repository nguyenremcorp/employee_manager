<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Profile;

/**
 * Class Department
 */
class Department extends Model
{
    /**
     * Summary of profiles
     * @return HasMany<Profile, Department>
     */
    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class);
    }
}
