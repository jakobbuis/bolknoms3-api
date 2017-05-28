<?php

namespace App\Models;

use App\Http\Transformers\UserTransformer;

class User extends Model
{
    protected $fillable = ['diet', 'blocked'];

    /**
     * The transformer for this model
     * @return TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserTransformer();
    }

    /**
     * A User can have registrations for meals
     * @return Relations\HasMany
     */
    public function registrations()
    {
        return $this->hasMany('App\Models\Registration')->orderBy('name');
    }

    /**
     * Return whether the user is registered to the meal
     * @param  Meal $meal
     * @return boolean       true if registered, false otherwise
     */
    public function registeredFor($meal)
    {
        return $this->registrations()->where(['meal_id' => $meal->id])->count() > 0;
    }

    /**
     * Return the Registration for this user and meal
     * @param  Meal $meal the meal
     * @return Registration
     */
    public function registrationFor($meal)
    {
        return $this->registrations()->where(['meal_id' => $meal->id])->first();
    }
}
