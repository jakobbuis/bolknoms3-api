<?php

namespace App\Console\Commands;

use App\Models\Meal;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GenerateMeals extends Command
{
    protected $signature = 'bolknoms:meals:generate';
    protected $description = 'Generate meals for the next week Monday through Thursday';

    public function handle()
    {
        // Get next monday
        $date = strtotime('next monday');

        // Walk until the thursday (4 days)
        for ($i=0; $i < 4; $i++) {
            $current_date = date('Y-m-d', strtotime("+{$i} days", $date));
            echo "Attempting {$current_date}...";
            if (Meal::withTrashed()->whereRaw("DATE(meal_timestamp) = '$current_date'")->count() == 0) {
                $meal = Meal::create([
                    'meal_timestamp' => $current_date.' 18:30:00',
                    'locked_timestamp' => $current_date.' 15:00:00',
                ]);
                Log::info("Generated meal for {$current_date}", $meal);
            } else {
                Log::info("Skipped generating meal for {$current_date}, a meal exists for this date");
            }
        }
    }
}
