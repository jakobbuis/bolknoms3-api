<?php

namespace App\Http\Transformers;

use App\Models\Registration;

class RegistrationTransformer extends \League\Fractal\TransformerAbstract
{
    protected $availableIncludes = ['meal', 'user', 'creator'];

    public function transform(Registration $registration)
    {
        return [
            'id' => (int) $registration->id,
            'name' => $registration->name,
            'diet' => !empty($registration->handicap) ? $registration->handicap : null,
            'confirmed' => $registration->confirmed,
        ];
    }

    public function includeMeal(Registration $registration)
    {
        $meal = $registration->meal;
        return $this->item($meal, $meal->getTransformer());
    }

    public function includeUser(Registration $registration)
    {
        $user = $registration->user;
        if (!$user) {
            return $this->null();
        }
        return $this->item($user, $user->getTransformer());
    }

    public function includeCreator(Registration $registration)
    {
        $creator = $registration->creator;
        if (!$creator) {
            return $this->null;
        }
        return $this->item($creator, $creator->getTransformer());
    }
}
