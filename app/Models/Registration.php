<?php

namespace App\Models;

use App\Http\Transformers\RegistrationTransformer;

class Registration extends Model
{
    protected $fillable = ['name', 'email', 'handicap'];

    public function getTransformer()
    {
        return new RegistrationTransformer;
    }

    /**
     * A registration belongs to a meal
     * @return Relations\BelongsTo
     */
    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    /**
     * A registration belongs to a user
     * @return Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A registratino is created by a user
     * @return Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope: all confirmed registrations
     */
    public function scopeConfirmed($query)
    {
        return $query->where('confirmed', '=', true);
    }

    /**
     * Scope: all unconfirmed registrations
     */
    public function scopeUnconfirmed($query)
    {
        return $query->where('confirmed', '=', false);
    }

    /**
     * Set the salt and save the model to the database.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = array())
    {
        // Set the salt
        if ($this->salt === null) {
            $this->salt = substr(str_shuffle(MD5(microtime())), 0, 10);
        }

        return parent::save($options);
    }
}
