<?php

namespace IgorTrinidad\ModelUtilities\Traits;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait UuidPrimary
{

    /**
     * Used by Eloquent to get primary key type.
     * UUID Identified as a string.
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    /**
     * Used by Eloquent to get if the primary key is auto increment value.
     * UUID is not.
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Boot function from laravel.
     */
    protected static function bootUuidPrimary()
    {

        // Create a UUID to the model if it does not have one
        static::creating(function (Model $model) {
            $model->keyType = 'string';
            $model->incrementing = false;

            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string)Uuid::uuid4();
            }
        });

        // Set original if someone try to change UUID on update/save existing model
        static::saving(function (Model $model) {

            $keyName = $model->getKeyName();

            $originalPrimaryKey = $model->getOriginal($keyName);

            if (!is_null($originalPrimaryKey)) {
                if ($originalPrimaryKey !== $model->{$keyName}) {
                    $model->{$keyName} = $originalPrimaryKey;
                }
            }
        });
    }
}
