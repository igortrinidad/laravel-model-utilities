<?php

namespace IgorTrinidad\ModelUtilities\Traits;

use Illuminate\Database\Eloquent\Model;

trait FormatDate
{

    /**
     * Boot function set Title Case for each column
     */
    protected static function bootFormatDate()
    {

        static::retrieved(function (Model $model) {

            if(isset($model->dateColumns) && gettype($model->dateColumns) == 'array') {
                foreach($model->dateColumns as $key => $value){

                    if(isset($model[$key]) && !is_null($model[$key])) {
                        $formatted = \DateTime::createFromFormat($value['unformatted'], $model[$key]);
                        $model[$key] = $formatted->format($value['formatted']);
                    }
                }
            }

        });

        static::saving(function (Model $model) {

            if(isset($model->dateColumns) && gettype($model->dateColumns) == 'array') {
                foreach($model->dateColumns as $key => $value){

                    if(isset($model[$key]) && !is_null($model[$key])) {
                        $formatted = \DateTime::createFromFormat($value['formatted'], $model[$key]);
                        $model[$key] = $formatted->format($value['unformatted']);
                    }
                }
            }

        });

    }



}
