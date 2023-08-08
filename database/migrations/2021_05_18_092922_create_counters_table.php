<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->id();
            $table->string('background_image');
            $table->string('image');
            $table->text('video');
            $table->string('counter_one_icon');
            $table->string('counter_one_count');
            $table->string('counter_one_title');
            $table->string('counter_two_icon');
            $table->string('counter_two_count');
            $table->string('counter_two_title');
            $table->string('counter_three_icon');
            $table->string('counter_three_count');
            $table->string('counter_three_title');
            $table->string('counter_four_icon');
            $table->string('counter_four_count');
            $table->string('counter_four_title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counters');
    }
}
