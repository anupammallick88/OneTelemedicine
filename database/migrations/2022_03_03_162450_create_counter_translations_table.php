<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counter_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->unsignedBigInteger('counter_id')->index();
            $table->unique(['counter_id', 'locale']);
            $table->foreign('counter_id')->references('id')->on('counters')->onDelete('cascade');

            $table->string('counter_one_count');
            $table->string('counter_one_title');
            $table->string('counter_two_count');
            $table->string('counter_two_title');
            $table->string('counter_three_count');
            $table->string('counter_three_title');
            $table->string('counter_four_count');
            $table->string('counter_four_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counter_translations');
    }
}
