<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Table name in database.
     *
     * @var string
     */
    protected $table = 'users';

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
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Summary of profile
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<Profile, User>
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }


    /**
     * Check isAmin role of user (call $user->isAdmin)
     *
     * @return boolean
     */
    public function getIsAdminAttribute(): bool
    {
        return $this->role == config('const.user_role.ADMIN');
    }

    /**
     * The "booting" method of the model.
     * 
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($user) {
            DB::transaction(function () use ($user) {
                if ($user->profile) {
                    $user->profile->delete();
                }
            });
        });
    }
}
