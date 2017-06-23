<?php

namespace App\Http\Controllers;

use App\Http\OAuth;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $fractal;
    protected $oauth;

    public function __construct(Manager $fractal, Request $request, OAuth $oauth)
    {
        $this->fractal = $fractal;
        if (!empty($request->include)) {
            $this->fractal->parseIncludes($request->include);
        }
        $this->oauth = $oauth;
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
        } else {
            $transformer = $data->getTransformer();
            $resource = new Item($data, $transformer);
        }

        return response($this->fractal->createData($resource)->toJson(), 200, [
            'Content-Type' => 'application/json',
        ]);
    }

    /**
     * Enfore the policy that the user must be a member
     * @param  string $explanation optional, appropriate explanation in case of denial
     * @throws ApiError when denied
     */
    public function clientMustBeMember($explanation = 'You must be a member to do this')
    {
        if (!$this->oauth->isMember()) {
            throw new ApiError(403, 'authorization_insufficient_level', $explanation);
        }
    }

    /**
     * Enfore the policy that the user must be a board member
     * @param  string $explanation optional, appropriate explanation in case of denial
     * @throws ApiError when denied
     */
    public function clientMustBeBoard($explanation = 'You must be a board member to do this')
    {
        if (!$this->oauth->isBoard()) {
            throw new ApiError(403, 'authorization_insufficient_level', $explanation);
        }
    }

    /**
     * Enforce the policy that a user must own an entity (board members own
     * basically everything in the system)
     * @param  App\Models\Model $model
     * @param  string $explanation optional, appropriate explanation in case of denial
     */
    public function clientMustOwn($model, $explanation = 'You do not own this object')
    {
        $error = new ApiError(403, 'authorization_not_owner', $explanation);

        // Board members effectively own everything
        if ($this->oauth->isBoard()) {
            return;
        }

        // If you're not a member, you can't own anything
        if (!$this->oauth->isMember()) {
            throw $error;
        }

        $currentUser = $this->oauth->user();
        if ($model instanceof User) {
            // Members own only themselves
            if ($model->id === $currentUser->id) {
                return;
            }
        } else {
            // Ownership is set through the user() relationship, which must exist
            if (!method_exists($model, 'user')) {
                throw new \Exception("$model cannot be owned by a user, i.e. it has no user() relationship");
            }
            if ($model->user->id === $currentUser->id) {
                return;
            }
        }

        throw $error;
    }

    /**
     * Format a bag of validation messages into the standard error response
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return Illuminate\Http\Response
     */
    public function formatValidationErrors(Validator $validator)
    {
        $errors = collect($validator->errors()->all())->map(function ($error) {
            return [
                'code' => 'validation_error',
                'description' => $error,
                'href' => env('ERROR_DOCS_URL') . 'validation_error',
            ];
        });

        return response()->json(['errors' => $errors], 400);
    }
}
