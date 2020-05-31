<?php

namespace IgorTrinidad\ModelUtilities\Traits;

use Illuminate\Database\Eloquent\Model;
use IgorTrinidad\ModelUtilities\ModelUtilities;

trait FormatCurrency
{

    /**
     * Boot function set Title Case for each column
     */
    protected static function bootFormatCurrency()
    {

        static::retrieved(function (Model $model) {

            if(isset($model->currencyColumns) && gettype($model->currencyColumns) == 'array') {
                foreach($model->currencyColumns as $key => $value){

                    if(isset($model[$key]) && !is_null($model[$key])) {
                        $formattedColumnName = 'formatted_' . $key;

                        $formattedValue = ModelUtilities::formatCurrency($model[$key], $value['prefix'], $value['precision'], $value['decimal'], $value['thousand']);

                        $model[$formattedColumnName] = $value['prefix'] . $formattedValue;
                    }

                }
            }

        });


    }



}
