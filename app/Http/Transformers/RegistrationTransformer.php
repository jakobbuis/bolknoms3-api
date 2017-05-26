<?php

namespace App\Http\Transformers;

use App\Models\Registration;

class RegistrationTransformer extends \League\Fractal\TransformerAbstract
{
    public function transform(Registration $registration)
    {
        return [
            'id' => (int) $registration->id,
            'name' => $registration->name,
            'diet' => !empty($registration->handicap) ? $registration->handicap : null,
            'confirmed' => $registration->confirmed,
        ];
    }
}
