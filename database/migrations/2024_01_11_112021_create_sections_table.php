<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();

            $table->string('inicio_titulo')->nullable();
            $table->text('inicio_descripcion')->nullable();
            $table->text('inicio_descripcion_2')->nullable();
            $table->string('video_fondo')->nullable();
            $table->string('video_link')->nullable();
            $table->text('video_titulo')->nullable();
            $table->text('video_descripcion')->nullable();

            $table->string('nosotros_imagen')->nullable();
            $table->text('nosotros_titulo')->nullable();
            $table->text('nosotros_descripcion')->nullable();
            $table->text('nosotros_descripcion2')->nullable();

            $table->text('contacto_titulo')->nullable();
            $table->text('contacto_descripcion')->nullable();
            $table->text('contacto_titulo2')->nullable();
            $table->text('contacto_descripcion2')->nullable();
            $table->text('contacto_direccion')->nullable();
            $table->text('contacto_telefono')->nullable();
            $table->text('contacto_telefono2')->nullable();
            $table->text('contacto_email')->nullable();
            $table->text('contacto_lunes_viernes')->nullable();
            $table->text('contacto_lunes_viernes2')->nullable();
            $table->text('contacto_domingo')->nullable();

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
        Schema::dropIfExists('sections');
    }
}
