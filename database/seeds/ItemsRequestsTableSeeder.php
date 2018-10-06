<?php

use Illuminate\Database\Seeder;

class ItemsRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 10 users using the user factory
        factory(App\Models\Pedidos_itens::class, 150)->create();
    }
}
