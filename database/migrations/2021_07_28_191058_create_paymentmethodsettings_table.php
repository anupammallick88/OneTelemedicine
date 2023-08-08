<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentmethodsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentmethodsettings', function (Blueprint $table) {
            $table->id();
            $table->string('PAYPAL_BASE_URI');
            $table->string('PAYPAL_CLIENT_ID');
            $table->string('PAYPAL_CLIENT_SECRET');
            $table->string('STRIPE_KEY');
            $table->string('STRIPE_SECRET');
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
        Schema::dropIfExists('paymentmethodsettings');
    }
}
