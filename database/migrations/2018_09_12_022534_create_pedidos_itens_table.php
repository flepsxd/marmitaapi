<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidositensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_itens', function (Blueprint $table) {
            $table->increments('idpedido_item');
            $table->unsignedInteger('idpedido')->nullable(false);
            $table->unsignedInteger('idproduto')->nullable(false);
            $table->decimal('vlrunitario', 15, 2)->default(0)->nullable(true);
            $table->unsignedInteger('quantidade')->default(1)->nullable(true);
            $table->decimal('vlrtotal', 15, 2)->default(0)->nullable(true);
            $table->decimal('desconto', 15, 2)->default(0)->nullable(true);
            $table->timestamps();

            $table->foreign('idpedido')->references('idpedido')->on('pedidos');
            $table->foreign('idproduto')->references('idproduto')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidositens');
    }
}
