<?php

namespace App\enum;

/**
 * Summary of MaritalStatus
 */
class MaritalStatus
{
    public const SINGLE = 'single';

    public const MARRED = 'married';

    public const DIVORCED = 'divorced';

     /**
     * Summary of label
     * @return string
     */
    public static function label(string $value)
    {
        return match ($value) {
            self::SINGLE => 'Độc thân',
            self::MARRED => 'Đã kết hôn',
            self::DIVORCED => 'Ly hôn',
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
            self::SINGLE => 'Độc thân',
            self::MARRED => 'Đã kết hôn',
            self::DIVORCED => 'Ly hôn',
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
            self::SINGLE,
            self::MARRED,
            self::DIVORCED,
        ];
    }
}
