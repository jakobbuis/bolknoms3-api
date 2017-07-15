<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiError;
use App\Models\Meal;
use App\Models\Registration;
use Illuminate\Http\Request;

class MealRegistrationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function index(Meal $meal)
    {
        return $this->respondWith($meal->registrations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Meal $meal)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meal  $meal
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Meal $meal, Registration $registration)
    {
        if ($registration->meal_id !== $meal->id) {
            throw new ApiError(
                400,
                'relationship_mismatch',
                'This registration does not relate to this meal. It belongs to ' . $registration->meal_id
            );
        }
        return $this->respondWith($registration);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meal  $meal
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meal $meal, Registration $registration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meal  $meal
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meal $meal, Registration $registration)
    {
        //
    }
}
