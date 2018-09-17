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

$factory->define(App\Models\Usuarios::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->unique()->name,
        'email' => $faker->unique()->email,
        'senha' => Hash::make('12345')
    ];
});
