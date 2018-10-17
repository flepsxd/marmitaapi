<?php

namespace App\Models;

class Bairros extends Geral
{
    protected $table = 'bairros';
    protected $primaryKey = 'idbairro';
    protected $fillable = [ 'nome' ];
    protected $guarded = ['idcidade'];
}
