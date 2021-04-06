j<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial', function (Blueprint $table) {
            $table->id('id_historial');
            $table->bigInteger('id_producto')->unsigned();
            $table->bigInteger('id_empleado')->unsigned();
            $table->integer('unidadesRetiradas');

            $table->foreign('id_producto')
            ->references('id_producto')
            ->on('producto')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->foreign('id_empleado')
            ->references('id_empleado')
            ->on('empleados')
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('historial');
    }
}
