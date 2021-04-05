<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableReporte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id('id_reportes');
            $table->bigInteger('id_producto')->unsigned();
            $table->decimal('inventarioPromedio',8,2);
            $table->decimal('costoConservacion',8,2);
            $table->decimal('costoPedido',8,2);
            $table->decimal('indiceExactitud',8,2);
            $table->timestamps();
            
            $table->foreign('id_producto')
            ->references('id_producto')
            ->on('producto')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reportes');
    }
}
