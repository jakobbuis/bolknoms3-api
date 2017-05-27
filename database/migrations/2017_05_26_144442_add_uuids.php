<?php

use App\Models\Meal;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddUuids extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create new columns for the keys, and drop all foreign keys
        Schema::table('users', function(Blueprint $table){
            $table->string('id_new', 32);
        });

        Schema::table('meals', function(Blueprint $table){
            $table->string('id_new', 32);
        });

        Schema::table('registrations', function(Blueprint $table){
            $table->string('id_new', 32);
            $table->string('meal_id_new', 32);
            $table->string('user_id_new', 32);
            $table->string('created_by_new', 32);

            $table->dropForeign('registrations_meal_id__meals_id');
            $table->dropForeign('registrations_meal_id_foreign');
        });

        // Prefill the new IDs
        DB::unprepared('UPDATE meals SET id_new = (SELECT UUID())');
        DB::unprepared('UPDATE users SET id_new = (SELECT UUID())');
        DB::unprepared('UPDATE registrations SET id_new = (SELECT UUID())');

        // Correct the foreign keys
        DB::unprepared('UPDATE registrations LEFT JOIN meals ON registrations.meal_id = meals.id SET meal_id_new = meals.id_new');
        DB::unprepared('UPDATE registrations LEFT JOIN users ON registrations.user_id = users.id SET user_id_new = users.id_new');
        DB::unprepared('UPDATE registrations LEFT JOIN users ON registrations.created_by = users.id SET created_by_new = users.id_new');

        // Drop old columns, rename columns
        Schema::table('users', function(Blueprint $table){
            $table->dropColumn('id');
            $table->renameColumn('id_new', 'id');
        });

        Schema::table('meals', function(Blueprint $table){
            $table->dropColumn('id');
            $table->renameColumn('id_new', 'id');
        });

        // Drop old columns, rename new to old, re-instate foreign keys
        Schema::table('registrations', function(Blueprint $table){
            $table->dropColumn('id');
            $table->renameColumn('id_new', 'id');
            $table->dropColumn('meal_id');
            $table->renameColumn('meal_id_new', 'meal_id');
            $table->dropColumn('user_id');
            $table->renameColumn('user_id_new', 'user_id');
            $table->dropColumn('created_by');
            $table->renameColumn('created_by_new', 'created_by');

            $table->foreign('meal_id')->references('id')->on('meals');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
