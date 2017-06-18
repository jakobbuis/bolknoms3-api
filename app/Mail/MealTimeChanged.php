<?php

namespace App\Mail;

use App\Models\Meal;
use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * E-mail to update all registrations when the meal_timestamp changes
 */
class MealTimeChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $meal;
    public $registration;

    public function __construct(Meal $meal, Registration $registration)
    {
        $this->meal = $meal;
        $this->registration = $registration;
    }

    public function build()
    {
        return $this->to($this->registration->email)
                    ->subject("Tijdstip maaltijd {$this->meal->mealDate} gewijzigd")
                    ->view('mail/meal_time_changed/html')
                    ->text('mail/meal_time_changed/text');
    }
}
