<?php

namespace App\Http\Transformers;

use App\Models\Meal;

class MealTransformer extends \League\Fractal\TransformerAbstract
{
    public function transform(Meal $meal)
    {
        return [
            'id' => (int) $meal->id,
            'meal' => $meal->meal_timestamp->toIso8601String(),
            'closed_for_registrations' => $meal->locked_timestamp->toIso8601String(),
            'event' => $meal->event,
        ];
    }
}
