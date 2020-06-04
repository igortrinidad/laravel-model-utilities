<?php

namespace IgorTrinidad\ModelUtilities\Traits;

use Illuminate\Database\Eloquent\Model;
use IgorTrinidad\ModelUtilities\ModelUtilities;

trait FullName
{

    /**
     * Boot function set Title Case for each column
     */
    protected static function bootFullName()
    {
        /**
         * Format a full_name attribute to the model
         */
        static::saving(function (Model $model) {

            if(isset($model->fullNames) && gettype($model->fullNames) == 'array') {
                foreach($model->fullNames as $key => $value){

                    if(!$value['onlyGetter']) {
                        $model[$key] = ModelUtilities::fullName($model->{$value['firstName']}, $model->{$value['lastName']});
                    }

                }
            }

        });

        /**
         * Format a full_name attribute to the model
         */
        static::retrieved(function (Model $model) {

            if(isset($model->fullNames) && gettype($model->fullNames) == 'array') {
                foreach($model->fullNames as $key => $value){

                    if($value['onlyGetter']) {
                        $model[$key] = ModelUtilities::fullName($model->{$value['firstName']}, $model->{$value['lastName']});
                    }

                }
            }

        });

    }



}
