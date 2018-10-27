<?php

use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 10 users using the user factory
        factory(App\Models\Agendamentos::class, 30)->create()->each(function ($agendamento) {
            $itens = factory(App\Models\Agendamentos_itens::class, 5)->make(['idagendamento' => $agendamento->idagendamento]);
            $agendamento->agendamento_itens()->saveMany($itens);
            $valor = $itens->sum(function($val){ 
                                return $val->vlrtotal;
                            });
            $agendamento->fill(['valor'=>$valor]);
            $agendamento->save();
        });
    }
}
