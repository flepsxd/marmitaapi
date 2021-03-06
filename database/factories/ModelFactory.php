<?php

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
 */

$factory->define(App\Models\Agendamentos_itens::class, function (Faker\Generator $faker) {
    $produto = App\Models\Produtos::inRandomOrder()->first();
    $quantidade = $faker->numberBetween(1, 20);
    $desconto = $faker->randomFloat(2, 0, $produto->preco);
    $vlrtotal = ($produto->preco * $quantidade) - $desconto;
    return [
        'vlrunitario' => $produto->preco,
        'quantidade' => $quantidade,
        'vlrtotal' => $vlrtotal,
        'desconto' => $desconto,
        'idproduto' => $produto->idproduto
    ];
});

$factory->define(App\Models\Agendamentos::class, function (Faker\Generator $faker) {
    $hora = Carbon::now();
    return [
        'idpessoa' => App\Models\Pessoas::pluck('idpessoa')->random(),
        'status' => $faker->randomElement(['A', 'I']),
        'idformapagto' => App\Models\Formapagtos::pluck('idformapagto')->random(),
        'hora' => Carbon::now(-3),
        'previsao' => Carbon::now(-3)->addMinutes(30),
        'observacoes' => $faker->realText,
        'proximodia' => true
    ];
});

$factory->define(App\Models\Bairros::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->citySuffix,
    ];
});

$factory->define(App\Models\Cidades::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->unique()->city,
        'uf' => $faker->unique()->stateAbbr
    ];
});

$factory->define(App\Models\Enderecos::class, function (Faker\Generator $faker) {
    return [
        'idbairro' => App\Models\Bairros::pluck('idbairro')->random(),
        'idcidade' => App\Models\Cidades::pluck('idcidade')->random(),
        'endereco' => $faker->streetName,
        'numero' => $faker->buildingNumber,
        'complemento' => $faker->secondaryAddress,
        'cep' => $faker->randomNumber(8, true)
    ];
});

$factory->define(App\Models\Lancamentos::class, function (Faker\Generator $faker) {
    return [
        'valor' => $faker->randomFloat(2),
        'idformapagto' => App\Models\Formapagtos::pluck('idformapagto')->random(),
        'datahora' => $faker->dateTime,
        'valorpago' => $faker->randomFloat(2),
        'datapagto' => $faker->dateTime
    ];
});

$factory->define(App\Models\Pedidos_itens::class, function (Faker\Generator $faker) {
    $produto = App\Models\Produtos::inRandomOrder()->first();
    $quantidade = $faker->numberBetween(1, 20);
    $desconto = $faker->randomFloat(2, 0, $produto->preco);
    $vlrtotal = ($produto->preco * $quantidade) - $desconto;
    return [
        'vlrunitario' => $produto->preco,
        'quantidade' => $quantidade,
        'vlrtotal' => $vlrtotal,
        'desconto' => $desconto,
        'idproduto' => $produto->idproduto
    ];
});
$factory->define(App\Models\Pedidos::class, function (Faker\Generator $faker) {
    return [
        'idpessoa' => App\Models\Pessoas::pluck('idpessoa')->random(),
        'datahora' => Carbon::now(-3),
        'idformapagto' => App\Models\Formapagtos::pluck('idformapagto')->random(),
        'previsao' => Carbon::now(-3)->addMinutes(30),
        'observacoes' => $faker->realText,
        'idendereco' => App\Models\Enderecos::pluck('idendereco')->random()
    ];
});
$factory->define(App\Models\Pedidos_ordem::class, function (Faker\Generator $faker) {
    $idetapa = App\Models\Etapas::pluck('idetapa')->random();
    $ordem = App\Models\Pedidos_ordem::where('idetapa', $idetapa)->orderBy('ordem', 'desc')->pluck('ordem')->first();
    $ordem = !is_null($ordem) ? ($ordem + 1) : 0;
    return [
        'ordem' => $ordem,
        'idetapa' => $idetapa
    ];
});
$factory->define(App\Models\Pessoas::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->unique()->name,
        'telefone' => $faker->phoneNumber,
        'email' => $faker->unique()->email,
        'status' => $faker->randomElement(['A', 'I']),
        'idendereco' => App\Models\Enderecos::pluck('idendereco')->random()
    ];
});
$factory->define(App\Models\Produtos::class, function (Faker\Generator $faker) {
    return [
        'descricao' => $faker->unique()->colorName,
        'preco' => $faker->randomFloat(2, 0.1, 90),
        'status' => $faker->randomElement(['A', 'I'])
    ];
});
$factory->define(App\Models\Usuarios::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->unique()->name,
        'email' => $faker->unique()->email,
        'senha' => Hash::make('12345'),
        'status' => $faker->randomElement(['A', 'I'])
    ];
});

