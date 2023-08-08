<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleFieldsNullableToAbouts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->string('icon_one_title')->nullable()->change();
            $table->string('icon_one_description')->nullable()->change();
            $table->string('icon_two_title')->nullable()->change();
            $table->string('icon_two_description')->nullable()->change();
            $table->string('icon_three_title')->nullable()->change();
            $table->string('icon_three_description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('abouts', function (Blueprint $table) {
            //
        });
    }
}
