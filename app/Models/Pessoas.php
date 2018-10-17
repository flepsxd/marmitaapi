<?php

namespace App\Models;

class Pessoas extends Geral
{
    protected $table = 'pessoas';
    protected $primaryKey = 'idpessoa';
    protected $fillable = ['nome', 'telefone', 'email', 'status', 'idendereco'];
    protected $guarded = ['idpessoa'];
    protected $appends = ['status_formatado'];
    public $with = ['endereco'];

    public function pedidos()
    {
        return $this->belongsToMany(Pedidos::class, 'idpessoa', 'idpessoa');
    }

    public function endereco()
    {
        return $this->hasOne(Enderecos::class, 'idendereco', 'idendereco');
    }

    public function getStatusFormatadoAttribute() {
        return $this->status == 'A' ? 'Ativo' : 'Inativo';
    }
}
