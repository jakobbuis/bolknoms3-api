<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveObsoletePromotedColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Move the data to the event column
        DB::unprepared("UPDATE meals SET event = 'evenement' WHERE event IS NULL AND promoted = 1");

        Schema::table('meals', function (Blueprint $table) {
            $table->dropColumn('promoted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meals', function (Blueprint $table) {
            $table->boolean('promoted');
        });
    }
}
