<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendamentositensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos_itens', function (Blueprint $table) {
            $table->increments('idagendamento_item');
            $table->unsignedInteger('idagendamento')->nullable(true);
            $table->unsignedInteger('idproduto')->nullable(true);
            $table->unsignedInteger('quantidade');
            $table->timestamps();

            $table->foreign('idagendamento')->references('idagendamento')->on('agendamentos');
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
        Schema::dropIfExists('agendamentositens');
    }
}
