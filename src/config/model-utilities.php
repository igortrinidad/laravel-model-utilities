<?php

return [

    /**
     * Format Currency global settings - default
     */
    'currency' => [

        /**
         * The attr_prefix will be added before the column name eg: formatted_value
         */
        'attr_prefix' => 'formatted_',
        'prefix' => 'US$ ',
        'decimal' => ',',
        'thousand' => '.',
        'precision' => 2
    ],

    /**
     * Format date global settings - default
     * You can override this settings inside your models if you need to change an specific column
     * You still need to tell what columns should be formatted inside your models in $dateColumns attributes
     */
    'date' => [

        /**
         * Same format as your DB date column you need to format
         */
        'unformatted' => 'Y-m-d',


        /**
         * The same format you return to your application
         * When creating or updating you don't need to format anymore
         * Just pass this same format to your model and the package treat the unformat to you
         */
        'formatted' => 'd/m/Y'
    ]

];
