<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Set the correct locale for PHP functions
        setlocale(LC_ALL, 'nl_NL.utf8');

        // Add a validation rule for ISO-8601 formatted dates
        Validator::extend('Iso8601Date', function ($attribute, $value, $parameters, $validator) {
            $regex = '/^(?:[1-9]\d{3}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1\d|2[0-8])|' .
                     '(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[1-9]' .
                     '\d(?:0[48]|[2468][048]|[13579][26])|(?:[2468][048]|[13579][26])00)' .
                     '-02-29)T(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d(?:Z|[+-][01]\d:[0-5]\d)$/';
            return preg_match_all($regex, $value) > 0;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
