<?php

namespace IgorTrinidad\ModelUtilities\Tests\Models;

use Illuminate\Database\Eloquent\Model;

use IgorTrinidad\ModelUtilities\Traits\UuidPrimary;
use IgorTrinidad\ModelUtilities\Traits\TitleCase;
use IgorTrinidad\ModelUtilities\Traits\SanitizeEmail;
use IgorTrinidad\ModelUtilities\Traits\FormatDate;
use IgorTrinidad\ModelUtilities\Traits\FormatCurrency;
use IgorTrinidad\ModelUtilities\Traits\FullName;

class Actor extends Model
{
    use UuidPrimary, TitleCase, SanitizeEmail, FormatDate, FormatCurrency, FullName;

    public $timestamps = false;

    /**
     * Here you can change the primary key of your model
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'full_name',
        'email',
        'bday',
        'payroll',
    ];

    /**
     * The columns that should be applied Title Case
     * This trait will format the columns that should be Title Case before saving in db
     *
     * @var array
     */
    protected $titleCases = [
        'name',
        'last_name'
    ];

    /**
     * The attribute of your model to create the fullName firstName . ' ' . lastName * applied title case
     * Set the onlyGetter attribute if you dont have a column in your DB of the fullName attribute
     * If the onlyGetter is set to true we just create the full_name attribute on model retrieved from db
     *
     * @var array
     */
    protected $fullNames = [
        //This key should be the same as attribute or column name
        'full_name' => [
            'onlyGetter' => false,
            'firstName' => 'name',
            'lastName' => 'last_name'
        ]
    ];

    /**
     * The columns to apply email sanitization
     *
     * @var array
     */
    protected $emailColumns = [
        'email'
    ];

    /**
     * The date columns that you want to format for the end user
     * The unformatted is the same of your database date format
     * The formatted is the way you want to show for your end user
     * This will format the date column just after retrieved of the db and unformat before saving in db
     *
     * @var array
     */
    protected $dateColumns = [
        'date'
    ];

    /**
     * The currency columns you want to format
     * This will create a model attribute like 'formatted_value'
     * 'value' is the name of the column in your dabase
     *
     * @var array
     */
    protected $currencyColumns = [
        'payroll'
    ];

}
