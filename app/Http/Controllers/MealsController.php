<?php

namespace App\Http\Controllers;

use App\Mail\MealCancelled;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MealsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->respondWith(Meal::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function show(Meal $meal)
    {
        return $this->respondWith($meal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meal $meal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meal $meal)
    {
        $this->clientMustBeBoard('Only board members can remove meals');

        // Email and remove all guests
        $meal->registrations->each(function($registration) use ($meal) {
            if ($registration->email) {
                Mail::send(new MealCancelled($meal, $registration));
            }
            $registration->delete();
        });

        $meal->delete();
        Log::info('Maaltijd {$meal->id} verwijderd door {$this->oauth->user()->id}');

        return response(null, 204);
    }
}
