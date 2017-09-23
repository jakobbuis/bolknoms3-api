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
     * The details of the current user of the token
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        $user = $this->oauth->user();
        if (!$user) {
            throw new ApiError(500, 'user_missing', 'You do not have a user account');
        }

        return $this->respondWith($user);
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
        // Users can only update themselves
        $this->clientMustOwn($user, 'You must be a board member to change other users');

        if (isset($request->diet)) {
            $user->diet = $request->diet;
        }

        // Only board members can (un)block users
        if (isset($request->blocked)) {
            if (!$this->oauth->isBoard()) {
                throw new ApiError(
                    403,
                    'authorization_insufficient_level',
                    'You must be a board member to (un)block a user'
                );
            }
            $user->blocked = !!$request->blocked;
        }

        $user->save();
        return $this->respondWith($user);
    }

    /**
     * Returns a list of all blocked users
     * @return Illuminate\Http\Response
     */
    public function blocked()
    {
        return $this->respondWith(User::blocked()->get());
    }
}
