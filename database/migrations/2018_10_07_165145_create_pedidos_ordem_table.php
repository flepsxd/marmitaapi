<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosOrdemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_ordem', function (Blueprint $table) {
            $table->increments('idpedido_ordem');
            $table->unsignedInteger('idpedido')->nullable(false);
            $table->unique('idpedido');
            $table->unsignedInteger('idetapa')->nullable(false);
            $table->integer('ordem')->nullable(false)->default(1);

            $table->timestamps();

            $table->foreign('idpedido')->references('idpedido')->on('pedidos');
            $table->foreign('idetapa')->references('idetapa')->on('etapas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos_ordem');
    }
}
