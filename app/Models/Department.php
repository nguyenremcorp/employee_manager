<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Profile;

/**
 * Class Department
 */
class Department extends Model
{
    use HasFactory;

    /**
     * Table name in database.
     *
     * @var string
     */
    protected $table = 'departments';

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
        'name',
    ];

    /**
     * Get user profile has in deparment 
     * 
     * @return HasMany<Profile, Department>
     */
    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class);
    }
}
