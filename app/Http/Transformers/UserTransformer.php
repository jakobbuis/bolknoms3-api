<?php

namespace App\Http\Transformers;

use App\Models\User;

class UserTransformer extends \League\Fractal\TransformerAbstract
{
    protected $availableIncludes = ['registrations'];

    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'username' => $user->username,
            'diet' => $user->handicap,
            'name' => $user->name,
            'blocked' => $user->blocked,
        ];
    }

    public function includeRegistrations(User $user)
    {
        $registrations = $user->registrations;
        return $this->collection($registrations, $registrations->first()->getTransformer());
    }
}
