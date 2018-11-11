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
            $table->decimal('vlrunitario', 15, 2)->default(0)->nullable(true);
            $table->unsignedInteger('quantidade')->default(1)->nullable(true);
            $table->decimal('vlrtotal', 15, 2)->default(0)->nullable(true);
            $table->decimal('desconto', 15, 2)->default(0)->nullable(true);
            $table->timestamps();

            $table->foreign('idagendamento')->references('idagendamento')->on('agendamentos')->onDelete('cascade');
            $table->foreign('idproduto')->references('idproduto')->on('produtos')->onDelete('set null');
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
