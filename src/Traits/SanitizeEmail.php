<?php

namespace IgorTrinidad\ModelUtilities\Traits;

use Illuminate\Database\Eloquent\Model;

trait SanitizeEmail
{


    /**
     * Boot function set Title Case for each column
     */
    protected static function bootSanitizeEmail()
    {

        static::saving(function (Model $model) {

            if(isset($model->emailColumns) && gettype($model->emailColumns) == 'array') {
                foreach($model->emailColumns as $emailColumn){
                    if(isset($model[$emailColumn]) && !is_null($model[$emailColumn])) {
                        $model[$emailColumn] = mb_strtolower(filter_var($model[$emailColumn], FILTER_SANITIZE_EMAIL));
                    }
                }
            }

        });

    }


}
