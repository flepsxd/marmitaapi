<?php

namespace App\Models;

class Usuarios extends Geral
{
    protected $table = 'usuarios';
    protected $fillable = [ 'nome', 'email', 'senha' ];
    protected $hidden = [ 'senha' ];
}
