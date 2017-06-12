<?php

namespace App\Mail;

use App\Models\Meal;
use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * E-mail to update all registrations
 */
class MealCancelled extends Mailable
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
                    ->subject("Maaltijd {$this->meal->humanDate} gaat niet door")
                    ->view('mail/meal_cancelled/html')
                    ->text('mail/meal_cancelled/text');
    }
}
