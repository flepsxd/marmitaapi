<?php

use Illuminate\Database\Seeder;

class FpgtoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        App\Models\Formapagtos::create([
            'idformapagto' => 1,
            'descricao' => 'Dinheiro'
        ]);
        App\Models\Formapagtos::create([
            'idformapagto' => 2,
            'descricao' => 'Visa Crédito'
        ]);
        App\Models\Formapagtos::create([
            'idformapagto' => 3,
            'descricao' => 'Master Crédito'
        ]);
        App\Models\Formapagtos::create([
            'idformapagto' => 4,
            'descricao' => 'Banri Débito',
        ]);
        App\Models\Formapagtos::create([
            'idformapagto' => 5,
            'descricao' => 'Banricompras'
        ]);
    }
}
