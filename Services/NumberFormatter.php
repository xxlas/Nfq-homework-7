<?php


namespace App\Services;

class NumberFormatter
{

    public function formatNumber($number)
    {
        switch ($number) {
            case $number >= 999500:
                return self::formatMillions($number);
            case $number >= 99950:
                return self::formatHundrethThousands($number);
            case $number >= 999.9999:
                return self::formatThousands($number);
            case $number >= 0:
                return self::formatBelowThousand($number);
            default:
                return $number;
        }
    }

    public static function formatMillions($number)
    {
        if (abs($number) >= 999500) {
            $number < 0 ? $substrLength = 5 : $substrLength = 4;

            return substr(number_format(round($number, -4), null, null, '.'), 0, $substrLength).'M';
        }
        return $number;
    }

    public static function formatHundrethThousands($number)
    {
        if (abs($number) >= 99950 && abs($number) < 999500) {
            $number < 0 ? $substrLength = 4 : $substrLength = 3;

            return substr(round($number, -3), 0, $substrLength).'K';
        }
        return $number;
    }

    public static function formatThousands($number)
    {
        if ((abs($number) >= 999.9999 && abs($number) < 99550)) {
            return number_format(round($number, 0), null, null, ' ');
        }
        return $number;
    }

    public static function formatBelowThousand($number)
    {
        if (abs($number) < 1000 && abs($number) >= 0) {
            $formattedNumber = number_format($number, '2', '.', null);
            if (substr($formattedNumber, -2) == '00') {
                return explode('.', $formattedNumber)[0];
            } else {
                return $formattedNumber;
            }
        }
        return $number;
    }
}