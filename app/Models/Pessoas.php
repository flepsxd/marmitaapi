<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoas extends Model
{
    protected $table = 'pessoas';
    protected $primaryKey = 'idpessoa';
    protected $fillable = ['nome', 'telefone', 'email', 'status', 'idendereco'];
    protected $guarded = ['idpessoa'];
    public $with = ['endereco'];

    public function pedidos()
    {
        return $this->belongsToMany(Pedidos::class, 'idpessoa', 'idpessoa');
    }

    public function endereco()
    {
        return $this->hasOne(Enderecos::class, 'idendereco', 'idendereco');
    }
}
