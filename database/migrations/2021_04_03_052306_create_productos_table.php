<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('codigo',50);
            $table->string('nombre',100);
            $table->decimal('costoPorOrden',8,2);
            $table->decimal('costoDeMantenimiento',8,2);
            $table->integer('unidadesAnuales');
            $table->integer('unidadesMensuales');
            $table->integer('stockTeorico');
            $table->integer('stockReal');
            $table->decimal('precio',8,2);
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
        Schema::dropIfExists('producto');
    }
}
