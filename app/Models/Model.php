<?php

namespace App\Models;

abstract class Model extends \Illuminate\Database\Eloquent\Model
{
    /**
     * The appropriate Fractal Transformer for this model
     * @return \League\Fractal\TransformerAbstract
     */
    abstract function getTransformer();
}
