<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 10 users using the user factory
        factory(App\Models\Usuarios::class, 10)->create();
        App\Models\Usuarios::create([
            'email' => 'yurigoular@gmail.com',
            'nome' => 'Yuri Goulart Correa',
            'senha' => '123456',
            'status' => 'A'
        ]);
    }
}
