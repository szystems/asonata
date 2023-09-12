<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id');
            $table->integer('cycle_id');
            $table->integer('atleta_id');
            $table->string('inscription_number')->nullable();
            $table->tinyInteger('inscription_payment')->nullable();
            $table->tinyInteger('badge_payment')->nullable();
            $table->integer('payments')->nullable();
            $table->tinyInteger('contract')->nullable();
            $table->mediumText('notes')->nullable();
            $table->tinyInteger('inscription_status')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('inscriptions');
    }
}
