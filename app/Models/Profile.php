<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Department;

/**
 * Class Profile
 */
class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'date_of_birth',
        'gender',
        'phone',
        'position',
        'cccd',
        'cccd_date',
        'marital_status',
        'start_date',
        'department_id',
    ];

    /**
     * Summary of user
     * @return BelongsTo<User, Profile>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Summary of department
     * @return BelongsTo<Department, Profile>
     */
    public function department(): BelongsTo    
    {
        return $this->belongsTo(Department::class);
    }
}
