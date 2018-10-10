<?php

use Illuminate\Database\Seeder;

class RequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 10 users using the user factory
        factory(App\Models\Pedidos::class, 50)->create()->each(function ($pedido) {
            $pedido->pedidos_itens()->saveMany(factory(App\Models\Pedidos_itens::class, 5)->make(['idpedido' => $pedido->idpedido]));
            factory(App\Models\Pedidos_ordem::class)->create(['idpedido' => $pedido->idpedido]);
        });
    }
}
