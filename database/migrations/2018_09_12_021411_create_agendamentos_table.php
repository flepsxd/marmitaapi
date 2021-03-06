<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->increments('idagendamento');
            $table->unsignedInteger('idpessoa')->nullable(true);
            $table->unsignedInteger('idformapagto')->nullable(true);
            $table->char('status', 1)->default('A');
            $table->time('hora')->useCurrent();
            $table->time('previsao');
            $table->decimal('valor', 12, 2);
            $table->string('observacoes', 300);
            $table->boolean('proximodia')->default(true);
            
            $table->timestamps();

            $table->foreign('idpessoa')->references('idpessoa')->on('pessoas')->onDelete('set null');
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
        Schema::dropIfExists('agendamentos');
    }
}
