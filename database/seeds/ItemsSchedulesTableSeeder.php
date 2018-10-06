<?php

use Illuminate\Database\Seeder;

class ItemsSchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 10 users using the user factory
        factory(App\Models\Agendamentos_itens::class, 80)->create();
    }
}
