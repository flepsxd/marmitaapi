<?php

use Illuminate\Database\Seeder;

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
            EtapaTableSeeder::class
        ]);
        Model::reguard();
    }
}
