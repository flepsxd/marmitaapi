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
            $itens = factory(App\Models\Pedidos_itens::class, 5)->make(['idpedido' => $pedido->idpedido]);
            $pedido->pedidos_itens()->saveMany($itens);
            $valor = $itens->sum(function($val){ 
                    return $val->vlrtotal;
                });
            $pedido->fill(['valor'=>$valor]);
            $pedido->save();
            $pedido->pedidos_ordem->update(factory(App\Models\Pedidos_ordem::class)->make(['idpedido' => $pedido->idpedido])->toArray());
            if($pedido->pedidos_ordem->etapa->geralancamento) {
                $pedido->lancamento()->save(factory(App\Models\Lancamentos::class)->make([
                    'idpedido' => $pedido->idpedido, 
                    'idpessoa'=>$pedido->idpessoa, 
                    'valor'=> $pedido->valor,
                    'valorpago'=>$pedido->valor,
                    'datapagto'=> $pedido->previsao,
                    'datahora' => $pedido->previsao
                ]));
            }
        });
    }
}
