<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLancamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lancamentos', function (Blueprint $table) {
            $table->increments('idlancamento');
            $table->unsignedInteger('idpessoa')->nullable(true);
            $table->unsignedInteger('idpedido')->nullable(true);
            $table->decimal('valor', 15, 2);
            $table->dateTime('datahora')->useCurrent();
            $table->decimal('valorpago', 15, 2);
            $table->dateTime('datapagto')->useCurrent();
            $table->timestamps();

            $table->foreign('idpessoa')->references('idpessoa')->on('pessoas');
            $table->foreign('idpedido')->references('idpedido')->on('pedidos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lancamentos');
    }
}
