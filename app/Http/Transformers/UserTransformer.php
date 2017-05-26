<?php

namespace App\Http\Transformers;

use App\Models\User;

class UserTransformer extends \League\Fractal\TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'username' => $user->username,
            'diet' => $user->handicap,
            'name' => $user->name,
            'blocked' => $user->blocked,
            'email' => $user->email,
        ];
    }
}
