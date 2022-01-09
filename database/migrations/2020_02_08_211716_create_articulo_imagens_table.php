<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticuloImagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo_imagens', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nombre');
            $table->Integer('articulo_id')->unsigned(); // clave foránea (campo relacionado con el campo id de la tabla articulos)
            $table->foreign('articulo_id')->references('id')->on('articulos')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('articulo_imagens');
    }
}
