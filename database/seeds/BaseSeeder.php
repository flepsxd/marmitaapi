<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // Register the user seeder
        $this->call([
            UsersTableSeeder::class,
            CityTableSeeder::class,
            NeightbourhoodTableSeeder::class,
            AddressTableSeeder::class,
            PersonTableSeeder::class,
            EtapaTableSeeder::class
        ]);
        Model::reguard();
    }
}
