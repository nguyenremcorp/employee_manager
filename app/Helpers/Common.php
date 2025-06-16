<?php

if (!function_exists('get_gender')) {
    /**
     * Get gender
     * 
     * @param string $gender
     * @return  string
     */
    function get_gender($gender): string
    {
        return __("const.gender.$gender") ?? '';
    }
}

if (!function_exists('get_user_role')) {
    /**
     * Get user role lable
     * 
     * @param string $role
     * @return string
     */
    function get_user_role($role): string
    {
        return __("const.user_role.$role") ?? '';
    }
}

if (!function_exists('get_marital_status')) {
    /**
     * Get user role
     * 
     * @param string $role
     * @return string
     */
    function get_marital_status($role): string
    {
        return __("const.marital.$role") ?? '';
    }
}

if (!function_exists('get_options')) {
    /**
     * Get option with format [key => value]
     * 
     * @param string $type
     * @return array
     */
    function get_options($type): array
    {
        if (!in_array($type, ['gender', 'marital', 'user_role'])) {
            return [];
        }

        $options = array_values(config("const.$type", []));

        return array_reduce($options, function ($arrOptions, $key) use ($type) {
            $arrOptions[$key] = __("const.$type.$key");
            return $arrOptions;
        }, []);
    }
}

if (!function_exists('get_values')) {
    /**
     * Get value of gender, marital, user_role
     * 
     * @param string $type
     * @return array
     */
    function get_values($type): array
    {
        if (!in_array($type, ['gender', 'marital', 'user_role'])) {
            return [];
        }

        return array_values(config("const.$type", []));
    }
}
