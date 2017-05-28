<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiError;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->respondWith(User::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->respondWith($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->oauth->mustBeMember();
        $data = $request->only('diet', 'blocked');
        if (sizeof($request->all()) !== sizeof($data)) {
            throw new ApiError(400, 'invalid_parameter', 'Can only send diet and blocked parameters.');
        }

        if ($data->blocked) {
            $this->oauth->mustBeBoard();
        }

        return 'check back soon';
    }
}
