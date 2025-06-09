<?php

namespace App\Enum;

/**
 * Summary of UserRole
 */
class UserRole
{
    public const ROLE_ADMIN = 'admin';

    public const ROLE_USER = 'user';

    /**
     * Summary of label
     * @return string
     */
    public static function label(string $value)
    {
        return match ($value) {
            self::ROLE_ADMIN => 'Quản trị',
            self::ROLE_USER => 'Người dùng',
        };
    }

    /**
     * Get all options as [value => label]
     *
     * @return array
     */
    public static function options()
    {
        return [
            self::ROLE_USER => 'Người dùng',
            self::ROLE_ADMIN => 'Quản trị',
        ];
    }

    /**
     * Get all raw values
     *
     * @return array
     */
    public static function values()
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_USER
        ];
    }
}
