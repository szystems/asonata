<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->string('name', 100);
            $table->string('age_from');
            $table->string('age_to');
            $table->mediumText('description')->nullable();
            $table->mediumText('requirements')->nullable();
            $table->mediumText('implements')->nullable();
            $table->string('image', 500)->nullable();
            $table->string('contract', 100)->nullable();
            $table->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('categories');
    }
}
