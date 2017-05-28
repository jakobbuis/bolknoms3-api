<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $fractal;

    public function __construct(Manager $fractal, Request $request)
    {
        $this->fractal = $fractal;
        if (!empty($request->include)) {
            $this->fractal->parseIncludes($request->include);
        }
    }

    /**
     * Return a formatted JSON response
     * @param  object $data
     * @return Illuminate\Http\Response
     */
    protected function respondWith($data)
    {
        if ($data instanceof \Illuminate\Database\Eloquent\Collection) {
            $transformer = $data->first()->getTransformer();
            $resource = new \League\Fractal\Resource\Collection($data, $transformer);
        }
        else {
            $transformer = $data->getTransformer();
            $resource = new Item($data, $transformer);
        }

        return response($this->fractal->createData($resource)->toJson(), 200, [
            'Content-Type' => 'application/json',
        ]);
    }
}
