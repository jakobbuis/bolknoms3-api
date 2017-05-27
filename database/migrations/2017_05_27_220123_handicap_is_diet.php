<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HandicapIsDiet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function(Blueprint $table){
            $table->renameColumn('handicap', 'diet');
        });

        Schema::table('users', function(Blueprint $table){
            $table->renameColumn('handicap', 'diet');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrations', function(Blueprint $table){
            $table->renameColumn('diet', 'handicap');
        });

        Schema::table('users', function(Blueprint $table){
            $table->renameColumn('diet', 'handicap');
        });
    }
}
