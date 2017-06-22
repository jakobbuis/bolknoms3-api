<?php

use App\Models\Meal;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FixDateColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Clean invalid dates from the database
        DB::unprepared("SET sql_mode = 'ALLOW_INVALID_DATES';");

        DB::unprepared("ALTER TABLE `users` MODIFY `created_at` TIMESTAMP NULL;");
        DB::unprepared("ALTER TABLE `users` MODIFY `updated_at` TIMESTAMP NULL;");
        DB::unprepared("ALTER TABLE `users` MODIFY `deleted_at` TIMESTAMP NULL;");

        DB::unprepared("UPDATE `users` SET `created_at` = NULL WHERE `created_at` = '0000-00-00 00:00:00';");
        DB::unprepared("UPDATE `users` SET `updated_at` = NULL WHERE `updated_at` = '0000-00-00 00:00:00';");
        DB::unprepared("UPDATE `users` SET `deleted_at` = NULL WHERE `deleted_at` = '0000-00-00 00:00:00';");

        DB::unprepared("ALTER TABLE `meals` MODIFY `created_at` TIMESTAMP NULL;");
        DB::unprepared("ALTER TABLE `meals` MODIFY `updated_at` TIMESTAMP NULL;");
        DB::unprepared("ALTER TABLE `meals` MODIFY `deleted_at` TIMESTAMP NULL;");

        DB::unprepared("UPDATE `meals` SET `created_at` = NULL WHERE `created_at` = '0000-00-00 00:00:00';");
        DB::unprepared("UPDATE `meals` SET `updated_at` = NULL WHERE `updated_at` = '0000-00-00 00:00:00';");
        DB::unprepared("UPDATE `meals` SET `deleted_at` = NULL WHERE `deleted_at` = '0000-00-00 00:00:00';");

        DB::unprepared("ALTER TABLE `registrations` MODIFY `created_at` TIMESTAMP NULL;");
        DB::unprepared("ALTER TABLE `registrations` MODIFY `updated_at` TIMESTAMP NULL;");
        DB::unprepared("ALTER TABLE `registrations` MODIFY `deleted_at` TIMESTAMP NULL;");

        DB::unprepared("UPDATE `registrations` SET `created_at` = NULL WHERE `created_at` = '0000-00-00 00:00:00';");
        DB::unprepared("UPDATE `registrations` SET `updated_at` = NULL WHERE `updated_at` = '0000-00-00 00:00:00';");
        DB::unprepared("UPDATE `registrations` SET `deleted_at` = NULL WHERE `deleted_at` = '0000-00-00 00:00:00';");

        // Fix the date column of every table to have a suitable default
        $tables = ['users', 'meals', 'registrations'];
        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->change();
                $table->datetime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->change();
                $table->datetime('deleted_at')->default(null)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        throw new \Exception('2017_05_25_133331_fix_date_columns cannot be reversed');
    }
}
