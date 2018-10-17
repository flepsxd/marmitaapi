<?php

namespace App\Models;

class Cidades extends Geral
{
    protected $table = 'cidades';
    protected $primaryKey = 'idcidade';
    protected $fillable = ['nome', 'uf'];
    protected $guarded = ['idcidade'];

    public function enderecos()
    {
        return $this->belongsToMany(Enderecos::class, 'idcidade', 'idcidade');
    }
}
