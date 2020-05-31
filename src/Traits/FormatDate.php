<?php

namespace IgorTrinidad\ModelUtilities\Traits;

use Illuminate\Database\Eloquent\Model;
use IgorTrinidad\ModelUtilities\ModelUtilities;

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

                        $model[$key] = ModelUtilities::formatDate($model[$key], $value['unformatted'], $value['formatted']);

                    }
                }
            }

        });

        static::saving(function (Model $model) {

            if(isset($model->dateColumns) && gettype($model->dateColumns) == 'array') {
                foreach($model->dateColumns as $key => $value){

                    if(isset($model[$key]) && !is_null($model[$key])) {

                        $model[$key] =  ModelUtilities::formatDate($model[$key], $value['formatted'], $value['unformatted']);

                    }
                }
            }

        });

    }



}
