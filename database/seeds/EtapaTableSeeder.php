<?php

use Illuminate\Database\Seeder;

class EtapaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        App\Models\Etapas::create([
            'idetapa' => 1,
            'etapa' => 'A',
            'descricao' => 'A Fazer'
        ]);
        App\Models\Etapas::create([
            'idetapa' => 2,
            'etapa' => 'I',
            'descricao' => 'Na Cozinha'
        ]);
        App\Models\Etapas::create([
            'idetapa' => 3,
            'etapa' => 'P',
            'descricao' => 'Pronto'
        ]);
        App\Models\Etapas::create([
            'idetapa' => 4,
            'etapa' => 'E',
            'descricao' => 'Entregando',
        ]);
        App\Models\Etapas::create([
            'idetapa' => 5,
            'etapa' => 'C',
            'descricao' => 'Entregue',
            'finalizado' => true,
            'geralancamento' => true
        ]);
    }
}
