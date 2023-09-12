<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('time_zone');
            $table->string('currency');
            $table->string('currency_simbol');
            $table->string('tax_status');
            $table->integer('tax');
            $table->tinyInteger('paypal');
            $table->tinyInteger('dbt');
            $table->string('shipping_description');
            $table->string('registration_process');
            $table->string('payments_description');
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
        Schema::dropIfExists('configs');
    }
}
