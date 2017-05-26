<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $fractal;

    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    protected function respondWith(Model $data)
    {
        if ($data instanceof \Illuminate\Database\Eloquent\Collection) {
            $transformer = $data->first()->getTransformer();
            $resource = new \League\Fractal\Resource\Collection($data, $transformer);
        }
        else {
            $transformer = $data->getTransformer();
            $resource = new Item($data, $transformer);
        }

        return response($this->fractal->createData($resource)->toJson())
                ->header('Content-Type', 'application/json')
                ->header('X-Api-Version', '1.0.0');
    }
}
