<?php

use Illuminate\Support\Facades\Hash;
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
    return [
        'idagendamento' => App\Models\Agendamentos::pluck('idagendamento')->random(),
        'idproduto' => App\Models\Produtos::pluck('idproduto')->random(),
        'quantidade' => $faker->randomDigit
    ];
});

$factory->define(App\Models\Agendamentos::class, function (Faker\Generator $faker) {
    return [
        'idpessoa' => App\Models\Pessoas::pluck('idpessoa')->random(),
        'status' => $faker->randomElement(['A', 'I'])
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
        'idpessoa' => App\Models\Pessoas::pluck('idpessoa')->random(),
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
        'idpessoa' => App\Models\Pessoas::pluck('idpessoa')->random(),
        'idpedido' => App\Models\Pedidos::pluck('idpedido')->random(),
        'valor' => $faker->randomFloat(2),
        'datahora' => $faker->dateTime,
        'valorpago' => $faker->randomFloat(2),
        'datapagto' => $faker->dateTime
    ];
});

$factory->define(App\Models\Pedidos_itens::class, function (Faker\Generator $faker) {
    return [
        'idpedido' => App\Models\Pedidos::pluck('idpedido')->random(),
        'idproduto' => App\Models\Produtos::pluck('idproduto')->random(),
        'vlrunitario' => $faker->randomFloat(2),
        'quantidade' => $faker->randomDigit,
        'vlrtotal' => $faker->randomFloat(2),
        'desconto' => $faker->randomFloat(2)
    ];
});
$factory->define(App\Models\Pedidos::class, function (Faker\Generator $faker) {
    return [
        'idagendamento' => App\Models\Agendamentos::pluck('idagendamento')->random(),
        'idpessoa' => App\Models\Pessoas::pluck('idpessoa')->random(),
        'idendereco' => App\Models\Enderecos::pluck('idendereco')->random(),
        'datahora' => $faker->dateTime,
        'etapa' => $faker->randomElement(['A', 'C', 'P', 'E', 'C']),
        'valor' => $faker->randomFloat(2),
        'observacoes' => $faker->realText,
        'status' => $faker->randomElement(['T', 'A', 'C', 'S', 'E'])
    ];
});
$factory->define(App\Models\Pessoas::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->unique()->name,
        'telefone' => $faker->phoneNumber,
        'email' => $faker->unique()->email,
        'status' => $faker->randomElement(['A', 'I'])
    ];
});
$factory->define(App\Models\Produtos::class, function (Faker\Generator $faker) {
    return [
        'descricao' => $faker->unique()->colorName,
        'preco' => $faker->randomFloat(2),
        'status' => $faker->randomElement(['A', 'I'])
    ];
});
$factory->define(App\Models\Usuarios::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->unique()->name,
        'email' => $faker->unique()->email,
        'senha' => Hash::make('12345')
    ];
});

