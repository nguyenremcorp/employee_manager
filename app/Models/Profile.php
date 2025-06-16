<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Department;

/**
 * Class Profile
 */
class Profile extends Model
{
    use HasFactory;

    /**
     * Table name in database.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * Primarykey of table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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
     * Get the user of profile.
     * 
     * @return BelongsTo<User, Profile>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the department of profile.
     * 
     * @return BelongsTo<Department, Profile>
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
