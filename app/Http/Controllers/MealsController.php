<?php

namespace App\Http\Controllers;

use App\Mail\MealCancelled;
use App\Mail\MealTimeChanged;
use App\Models\Meal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
        $this->clientMustBeBoard('Only board members can create meals');

        $validator = Validator::make($request->all(), [
            'meal_timestamp' => ['iso_8601_date', 'required', 'after:now', 'unique:meals'],
            'registration_close' => ['iso_8601_date', 'required', 'after:now', 'before:meal_timestamp'],
            'event' => ['string', 'max:255'],
        ]);
        if ($validator->fails()) {
            return $this->formatValidationErrors($validator);
        }

        return Meal::create([
            'meal_timestamp' => new Carbon($request->meal_timestamp),
            'locked_timestamp' => new Carbon($request->registration_close),
            'event' => $request->event,
        ]);
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
        $this->clientMustBeBoard('Only board members can change meals');

        $shouldEmail = false;
        if (!empty($request->meal_timestamp)) {
            $meal->meal_timestamp = new Carbon($request->meal_timestamp);
            $shouldEmail = true;
        }

        if (!empty($request->registration_close)) {
            $meal->locked_timestamp = new Carbon($request->registration_close);
        }

        if (!empty($request->event)) {
            $meal->event = $request->event;
        }

        // E-mail all attendees if the meal time of day changes
        if ($shouldEmail && $meal->isDirty('meal_timestamp')) {
            // Email and remove all guests
            $meal->registrations->each(function ($registration) use ($meal) {
                if ($registration->email) {
                    Mail::send(new MealTimeChanged($meal, $registration));
                }
            });
        }

        $meal->save();
        return $this->respondWith($meal);
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
        $meal->registrations->each(function ($registration) use ($meal) {
            if ($registration->email) {
                Mail::send(new MealCancelled($meal, $registration));
            }
            $registration->delete();
        });

        $meal->delete();
        Log::info('Maaltijd {$meal->id} verwijderd door {$this->oauth->user()->id}');

        return response(null, 204);
    }

    public function today()
    {
        return $this->respondWith(Meal::today()->get());
    }

    public function upcoming()
    {
        return $this->respondWith(Meal::upcoming()->get());
    }

    public function available()
    {
        return $this->respondWith(Meal::available()->get());
    }
}
