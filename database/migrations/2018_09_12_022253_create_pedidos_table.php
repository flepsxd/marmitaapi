<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('idpedido');
            $table->unsignedInteger('idagendamento')->nullable(true);
            $table->unsignedInteger('idpessoa')->nullable(true);
            $table->unsignedInteger('idendereco')->nullable(false);
            $table->unsignedInteger('idformapagto')->nullable(true);
            $table->dateTime('datahora')->useCurrent();
            $table->dateTime('previsao');
            $table->decimal('valor', 12, 2);
            $table->string('observacoes', 300);
            $table->timestamps();

            $table->foreign('idpessoa')->references('idpessoa')->on('pessoas')->onDelete('set null');
            $table->foreign('idagendamento')->references('idagendamento')->on('agendamentos');
            $table->foreign('idendereco')->references('idendereco')->on('enderecos');
            $table->foreign('idformapagto')->references('idformapagto')->on('formapagtos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
