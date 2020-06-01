<?php

namespace IgorTrinidad\ModelUtilities;

class ModelUtilities {


    const DEFAULT_CURRENCY_SETTINGS = [
        'attr_prefix' => 'formatted_',
        'prefix' => 'US$ ',
        'decimal' => ',',
        'thousand' => '.',
        'precision' => 2
    ];

    const DEFAULT_DATE_SETTINGS = [
        'unformatted' => 'Y-m-d',
        'formatted' => 'd/m/Y'
    ];

    /**
     * Return a formatted date
     */
    public static function formatDate(string $date, array $dateSettings = null)
    {

        $dateConfig = config('model-utilities.date');

        if($dateSettings) {
            $date = \DateTime::createFromFormat($dateSettings['unformatted'], $date);
            if(!$date) return false;
            return $date->format($dateSettings['formatted']);
        }

        if($dateConfig) {
            $date = \DateTime::createFromFormat($dateConfig['unformatted'], $date);
            if(!$date) return false;
            return $date->format($dateConfig['formatted']);
        } else {
            $date = \DateTime::createFromFormat(self::DEFAULT_DATE_SETTINGS['unformatted'], $date);
            if(!$date) return false;
            return $date->format(self::DEFAULT_DATE_SETTINGS['formatted']);
        }

    }

    /**
     * Return a unformatted date
     */
    public static function unformatDate(string $date, array $dateSettings = null)
    {

        $dateConfig = config('model-utilities.date');

        if($dateSettings) {
            $date = \DateTime::createFromFormat($dateSettings['formatted'], $date);
            if(!$date) return false;
            return $date->format($dateSettings['unformatted']);
        }

        if($dateConfig) {
            $date = \DateTime::createFromFormat($dateConfig['formatted'], $date);
            if(!$date) return false;
            return $date->format($dateConfig['unformatted']);
        } else {
            $date = \DateTime::createFromFormat(self::DEFAULT_DATE_SETTINGS['formatted'], $date);
            if(!$date) return false;
            return $date->format(self::DEFAULT_DATE_SETTINGS['unformatted']);
        }

    }

    /**
     * Return a formatted currency value
     */
    public static function formatCurrency($value, array $currencySettings = null)
    {

        $formatCurrencyConfig = config('model-utilities.currency');

        if($currencySettings) {
            return $currencySettings['prefix'] . number_format($value, $currencySettings['precision'], $currencySettings['decimal'], $currencySettings['thousand']);
        }

        if($formatCurrencyConfig) {
            return $formatCurrencyConfig['prefix'] . number_format($value, $formatCurrencyConfig['precision'], $formatCurrencyConfig['decimal'], $formatCurrencyConfig['thousand']);
        } else {
            return self::DEFAULT_CURRENCY_SETTINGS['prefix'] . number_format($value, self::DEFAULT_CURRENCY_SETTINGS['precision'], self::DEFAULT_CURRENCY_SETTINGS['decimal'], self::DEFAULT_CURRENCY_SETTINGS['thousand']);
        }


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
