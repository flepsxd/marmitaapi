<?php

use Illuminate\Database\Seeder;

class NeightbourhoodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 10 users using the user factory
        factory(App\Models\Bairros::class, 40)->create();
    }
}
