<?php

namespace App\Helpers;

class TextHelper
{
    /**
     * @param string $string
     * @return string
     */
    public static function leaveOnlyNumbers(string $string): string
    {
        return preg_replace('/[^0-9]/', '', $string);
    }

    /**
     * @param string $phone
     * @return string
     */
    public static function prepareFormatPhone(string $phone): string
    {
        $phone = str_replace('+7', 8, $phone);

        return self::leaveOnlyNumbers($phone);
    }
}
