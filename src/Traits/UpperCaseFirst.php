<?php

namespace IgorTrinidad\ModelUtilities\Traits;

use Illuminate\Database\Eloquent\Model;
use IgorTrinidad\ModelUtilities\ModelUtilities;

trait UpperCaseFirst
{


    /**
     * Boot function set UpperCaseFirst Case for each column
     */
    protected static function bootUpperCaseFirst()
    {

        static::saving(function (Model $model) {

            if(isset($model->upperCaseFirst) && gettype($model->upperCaseFirst) == 'array') {
                foreach($model->upperCaseFirst as $upperCaseColumn){

                    if(isset($model[$upperCaseColumn]) && !is_null($model[$upperCaseColumn])) {
                        $model[$upperCaseColumn] = ModelUtilities::upperCaseFirst($model[$upperCaseColumn]);
                    }
                }
            }

        });

    }


}
