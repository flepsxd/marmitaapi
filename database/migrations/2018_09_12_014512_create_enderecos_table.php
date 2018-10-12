<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->increments('idendereco');
            $table->unsignedInteger('idbairro')->nullable(false);
            $table->unsignedInteger('idcidade')->nullable(false);
            $table->string('endereco', 150)->nullable(false);
            $table->unsignedInteger('numero')->nullable(false);
            $table->string('complemento', 200)->nullable(false);
            $table->string('cep', 9)->nullable(false);
            $table->timestamps();

            $table->foreign('idbairro')->references('idbairro')->on('bairros');
            $table->foreign('idcidade')->references('idcidade')->on('cidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
}
