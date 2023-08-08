<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->text('title');
            $table->text('description');
            $table->string('icon_one');
            $table->string('icon_one_title');
            $table->string('icon_one_description');
            $table->string('icon_two');
            $table->string('icon_two_title');
            $table->string('icon_two_description');
            $table->string('icon_three');
            $table->string('icon_three_title');
            $table->string('icon_three_description');
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
        Schema::dropIfExists('abouts');
    }
}
