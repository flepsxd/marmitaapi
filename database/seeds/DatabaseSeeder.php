<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
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
            BaseSeeder::class,
            ProductsTableSeeder::class,
            SchedulesTableSeeder::class,
            ItemsSchedulesTableSeeder::class,
            RequestsTableSeeder::class,
            ReleasesTableSeeder::class
        ]);
        Model::reguard();
    }
}
