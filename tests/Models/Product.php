<?php

namespace IgorTrinidad\ModelUtilities\Tests\Models;

use Illuminate\Database\Eloquent\Model;

use IgorTrinidad\ModelUtilities\Traits\UuidPrimary;
use IgorTrinidad\ModelUtilities\Traits\UpperCaseFirst;
use IgorTrinidad\ModelUtilities\Traits\FormatCurrency;

class Product extends Model
{
    use UuidPrimary, UpperCaseFirst, FormatCurrency;

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
        'value',
    ];

    /**
     * The columns that should be applied Title Case
     * This trait will format the columns that should be Title Case before saving in db
     *
     * @var array
     */
    protected $upperCaseFirst = [
        'name'
    ];
    /**
     * The currency columns you want to format
     * This will create a model attribute like 'formatted_value'
     * 'value' is the name of the column in your dabase
     *
     * @var array
     */
    protected $currencyColumns = [
        'value' => [
            'attr_prefix' => 'formatted_',
            'prefix' => 'R$ ',
            'decimal' => ',',
            'thousand' => '.',
            'precision' => 2
        ]
    ];

}
