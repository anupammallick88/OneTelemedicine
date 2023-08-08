<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileImageAndThumbImageToDoctors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->text('profile_image')->nullable();
            $table->text('thumb_image')->nullable();
            $table->string('registration')->nullable();
            $table->text('file_one')->nullable();
            $table->text('file_two')->nullable();
            $table->text('file_three')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['profile_image', 'thumb_image']);
        });
    }
}
