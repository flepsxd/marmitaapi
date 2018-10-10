<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'idpedido';
    protected $fillable = ['idagendamento', 'idendereco', 'idpessoa', 'datahora', 'valor', 'observacoes', 'status'];
    protected $guarded = ['idpedido'];
    protected $appends = ['etapa', 'ordem', 'status_formatado'];
    public $with = ['pessoas.endereco', 'pedidos_itens', 'pedidos_ordem.etapa'];

    public function pedidos_itens()
    {
        return $this->hasMany(Pedidos_itens::class, 'idpedido', 'idpedido');
    }

    public function pessoas()
    {
        return $this->hasOne(Pessoas::class, 'idpessoa', 'idpessoa');
    }

    public function endereco()
    {
        return $this->hasOne(Enderecos::class, 'idendereco', 'idendereco');
    }

    public function pedidos_ordem()
    {
        return $this->hasOne(Pedidos_ordem::class, 'idpedido', 'idpedido');
    }

    public function getStatusFormatadoAttribute()
    {
        return $this->pedidos_ordem->etapa->descricao;
    }

    public function getEtapaAttribute()
    {
        return $this->pedidos_ordem->idetapa;
    }

    public function getOrdemAttribute()
    {
        return $this->pedidos_ordem->ordem;
    }

}
