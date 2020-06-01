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

        /**
         * Format date columns when retrieving from DB
         */
        static::retrieved(function (Model $model) {

            if(isset($model->dateColumns) && gettype($model->dateColumns) == 'array') {

                $dateConfig = config('model-utilities.date');

                foreach($model->dateColumns as $key => $value){

                    if(gettype($value) == 'array' && isset($model[$key]) && !is_null($model[$key])) {

                        $dateFormatted = ModelUtilities::formatDate($model[$key], $value);

                        if($dateFormatted) {
                            $model[$key] = $dateFormatted;
                        }

                    }  else if(gettype($value) == 'string' && isset($model[$value]) && !is_null($model[$value])) {

                        $dateFormatted = ModelUtilities::formatDate($model[$value]);

                         if($dateFormatted) {
                            $model[$value] = $dateFormatted;
                         }

                    }
                }
            }

        });

        /**
         * UNformat date columns when saving the record in DB
         */
        static::saving(function (Model $model) {

            if(isset($model->dateColumns) && gettype($model->dateColumns) == 'array') {

                $dateConfig = config('model-utilities.date');

                foreach($model->dateColumns as $key => $value){

                    if(gettype($value) == 'array' && isset($model[$key]) && !is_null($model[$key])) {

                        $dateUnformatted = ModelUtilities::unformatDate($model[$key], $value);

                        if($dateUnformatted) {
                            $model[$key] = $dateUnformatted;
                        }

                    }  else if(gettype($value) == 'string' && isset($model[$value]) && !is_null($model[$value])) {

                        $dateUnformatted = ModelUtilities::unformatDate($model[$value]);

                        if($dateUnformatted) {
                            $model[$value] = $dateUnformatted;
                        }

                    }
                }
            }

        });

    }



}
