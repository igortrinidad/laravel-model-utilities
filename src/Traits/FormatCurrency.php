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

                $formatCurrencyConfig = config('model-utilities.currency');

                foreach($model->currencyColumns as $key => $value){

                    if(gettype($value) == 'array' && isset($model[$key]) && !is_null($model[$key])) {
                        $formattedColumnName = $value['attr_prefix'] . $key;
                        $model[$formattedColumnName] = ModelUtilities::formatCurrency($model[$key], $value);

                    } else if(gettype($value) == 'string' && isset($model[$value]) && !is_null($model[$value])) {

                        if($formatCurrencyConfig) {
                            $formattedColumnName = $formatCurrencyConfig['attr_prefix'] . $value;
                            $model[$formattedColumnName] = ModelUtilities::formatCurrency($model[$value]);
                        } else {
                            $formattedColumnName = ModelUtilities::DEFAULT_CURRENCY_SETTINGS['attr_prefix'] . $value;
                            $model[$formattedColumnName] = ModelUtilities::formatCurrency($model[$value]);
                        }

                    }

                }
            }

        });


    }



}
