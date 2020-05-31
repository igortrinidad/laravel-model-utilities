<?php

namespace IgorTrinidad\ModelUtilities;

class ModelUtilities {

    /**
     * Return a formatted date
     */
    public static function formatDate(string $date, string $from = 'Y-m-d', string $to = 'd/m/Y')
    {
        $formatted = \DateTime::createFromFormat($from, $date);
        return $formatted->format($to);
    }

    /**
     * Return a formatted currency value
     */
    public static function formatCurrency($value, string $prefix = '$ ', int $precision = 2, string $decimal = ',', string $thousand = '.')
    {
        return $prefix . number_format($value, $precision, $decimal, $thousand);
    }

    /**
    * sanitizeEmail
    */
    public static function sanitizeEmail(string $email)
    {
        return mb_strtolower(filter_var($email, FILTER_SANITIZE_EMAIL));
    }

    /**
    * titleCase
    */
    public static function titleCase(string $string)
    {
        return mb_convert_case($string,  MB_CASE_TITLE);
    }


}
