<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('appointment_id');
            $table->integer('patient_id');
            $table->integer('patient_weight')->nullable();
            $table->integer('patient_age')->nullable();
            $table->integer('patient_bp')->nullable();
            $table->integer('patient_temperature')->nullable();
            $table->string('medicine_name')->nullable();
            $table->string('medicine_type')->nullable();
            $table->string('medicine_quantity')->nullable();
            $table->string('medicine_dose')->nullable();
            $table->string('medicine_day')->nullable();
            $table->string('medicine_comment')->nullable();
            $table->string('advice')->nullable();
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
        Schema::dropIfExists('prescriptions');
    }
}
