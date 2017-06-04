<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

abstract class Model extends \Illuminate\Database\Eloquent\Model
{
    /*
     * No models are removed from the database upon deletion
     */
    use SoftDeletes;
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The appropriate Fractal Transformer for this model
     * @return \League\Fractal\TransformerAbstract
     */
    abstract function getTransformer();

    /*
     * Models use UUIDs for the their primary key
     */
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::uuid4();
        });
    }
}
