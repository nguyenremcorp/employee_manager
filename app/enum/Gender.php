<?php

namespace App\Enum;

/**
 * Summary of Gender
 */
class Gender
{
    public const FEMALE = 'female';
    public const MALE = 'male';

    /**
     * Get the label of gender
     *
     * @param string $value
     * @return string
     */
    public static function label(string $value)
    {
        return match ($value) {
            self::FEMALE => 'Nữ',
            self::MALE => 'Nam',
            default => ''
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
            self::FEMALE => 'Nữ',
            self::MALE => 'Nam',
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
            self::FEMALE,
            self::MALE,
        ];
    }
}
