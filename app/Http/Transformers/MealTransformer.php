<?php

namespace App\Http\Transformers;

use App\Models\Meal;

class MealTransformer extends \League\Fractal\TransformerAbstract
{
    protected $availableIncludes = ['registrations'];

    public function transform(Meal $meal)
    {
        return [
            'id' => $meal->id,
            'meal' => $meal->meal_timestamp->toIso8601String(),
            'registration_close' => $meal->locked_timestamp->toIso8601String(),
            'event' => $meal->event,
        ];
    }

    public function includeRegistrations(Meal $meal)
    {
        $registrations = $meal->registrations;
        return $this->collection($registrations, $registrations->first()->getTransformer());
    }
}
