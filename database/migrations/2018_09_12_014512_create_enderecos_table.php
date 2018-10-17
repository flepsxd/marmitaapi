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
            $table->unsignedInteger('idbairro')->nullable(true);
            $table->unsignedInteger('idcidade')->nullable(true);
            $table->string('endereco', 150)->nullable(true);
            $table->unsignedInteger('numero')->nullable(true);
            $table->string('complemento', 200)->nullable(true);
            $table->string('cep', 9)->nullable(true);
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
