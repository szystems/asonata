<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class', function (Blueprint $table) {
            $table->id();
            $table->integer('cycle_id');
            $table->integer('category_id');
            $table->integer('schedule_id');
            $table->integer('instructor_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->mediumText('notes')->nullable();
            $table->decimal('inscription_payment');
            $table->decimal('monthly_payment');
            $table->decimal('badge');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('class');
    }
}
