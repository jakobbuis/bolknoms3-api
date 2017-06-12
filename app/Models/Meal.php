<?php

namespace App\Models;

use App\Http\Transformers\MealTransformer;
use Carbon\Carbon;

class Meal extends Model
{
    protected $fillable = ['event', 'promoted', 'meal_timestamp', 'locked_timestamp'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'meal_timestamp', 'locked_timestamp'];

    public function getTransformer()
    {
        return new MealTransformer;
    }

    /**
     * Relationship: one meal has many registrations
     * @return Relations\HasMany
     */
    public function registrations()
    {
        return $this->hasMany('App\Models\Registration')->orderBy('name');
    }

    /**
     * Scope: all meals open for new registrations
     */
    public function scopeAvailable($query)
    {
        return $query->where(function($q){
            $q->whereRaw('locked_timestamp > NOW()');
        })->orderBy('meal_timestamp');
    }

    /**
     * Scope: all meals dated today or later
     */
    public function scopeUpcoming($query)
    {
        return $query->where('meal_timestamp', '>=', date('Y-m-d'))->orderBy('meal_timestamp', 'asc');
    }

    /**
     * Scope: the meal for today, if any
     */
    public function scopeToday($query)
    {
        return $query->where(DB::raw('DATE_FORMAT(`meal_timestamp`, "%Y-%m-%d")'), '=', date('Y-m-d'));
    }

    /**
     * Return whether this meal can be subscribed to
     * @return boolean true if the meal is open for registrations, false if not
     */
    public function open_for_registrations()
    {
      return $this->locked_timestamp->timestamp > time();
    }

    /**
     * Virtual attribute to format the date of meal consistently.
     * Prints the Dutch-formatted date, adding the time if not standard
     * @return string formatted date, and time if needed
     */
    public function getHumanDateAttribute()
    {
        return $this->humanFormatDate($this->meal_timestamp, '18:30');
    }

    /**
     * Virtual attribute to format the deadline of meal consistently.
     * Prints the Dutch-formatted date, adding the time if not standard
     * @return string formatted date, and time if needed
     */
    public function getHumanDeadlineAttribute()
    {
        return $this->humanFormatDate($this->locked_timestamp, '15:00');
    }

    /**
     * Utility function to format human-readable date
     * @param  Carbon $date
     * @param  string $defaultTime
     * @return string
     */
    private function humanFormatDate(Carbon $date, string $defaultTime)
    {
        $format = '%A %d %B %Y';

        // If the time is not default, i.e. 18:30, we add it for clarity
        if ($date->format('H:i') !== $defaultTime) {
            $format .= ' %R uur';
        }

        return $date->formatLocalized($format);
    }
}
