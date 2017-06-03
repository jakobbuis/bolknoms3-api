<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

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
}
