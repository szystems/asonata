<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtletaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atleta', function (Blueprint $table) {
            $table->id();
            $table->integer('cui_dpi')->unique();
            $table->string('name', 100);
            $table->string('image', 100)->nullable();
            $table->string('vaccination_card', 100)->nullable();
            $table->string('birth_certificate', 100)->nullable();
            $table->date('birth');
            $table->tinyInteger('gender');

            $table->string('doses_number', 20);
            $table->string('ethnic_group', 20);
            $table->string('education_obtained', 50);
            $table->string('tshirt_size', 10);

            $table->string('phone', 20);
            $table->string('whatsapp', 20);
            $table->string('email', 100);
            $table->string('address', 500);
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('country', 50);
            $table->tinyInteger('status');
            $table->string('responsible_name', 100);
            $table->integer('responsible_dpi')->nullable();
            $table->integer('signed_contract')->nullable();
            $table->string('responsible_image',100);
            $table->string('responsible_phone', 20);
            $table->string('responsible_whatsapp', 20);
            $table->string('responsible_email', 100);
            $table->string('responsible_address', 200);

            $table->string('kinship', 20);
            $table->string('responsible_doses_number', 20);

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
        Schema::dropIfExists('atleta');
    }
}
