<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealsRegistrationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function index(Meal $meal)
    {
        //
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
        //
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
