<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->increments('idpessoa');
            $table->unsignedInteger('idendereco')->nullable(false);
            $table->string('nome', 100);
            $table->string('telefone', 20);
            $table->string('email', 100);
            $table->char('status', 1)->default('A');
            $table->timestamps();

            $table->foreign('idendereco')->references('idendereco')->on('enderecos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}
