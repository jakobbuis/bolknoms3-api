<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = ['name', 'email', 'handicap'];

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
