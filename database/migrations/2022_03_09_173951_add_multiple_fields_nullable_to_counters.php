<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleFieldsNullableToCounters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('counters', function (Blueprint $table) {
            $table->string('counter_one_count')->nullable()->change();
            $table->string('counter_one_title')->nullable()->change();
            $table->string('counter_two_count')->nullable()->change();
            $table->string('counter_two_title')->nullable()->change();
            $table->string('counter_three_count')->nullable()->change();
            $table->string('counter_three_title')->nullable()->change();
            $table->string('counter_four_count')->nullable()->change();
            $table->string('counter_four_title')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('counters', function (Blueprint $table) {
            //
        });
    }
}
