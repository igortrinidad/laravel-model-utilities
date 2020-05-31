<?php

namespace IgorTrinidad\ModelUtilities\Traits;

use Illuminate\Database\Eloquent\Model;

trait TitleCase
{


    /**
     * Boot function set Title Case for each column
     */
    protected static function bootTitleCase()
    {

        static::saving(function (Model $model) {

            if(isset($model->titleCases) && gettype($model->titleCases) == 'array') {
                foreach($model->titleCases as $titleCaseColumn){

                    if(isset($model[$titleCaseColumn]) && !is_null($model[$titleCaseColumn])) {
                        $model[$titleCaseColumn] = mb_convert_case($model[$titleCaseColumn],  MB_CASE_TITLE);
                    }
                }
            }

        });

    }


}
