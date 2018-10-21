<?php

namespace App\Models;

use Carbon\Carbon;

class Pedidos extends Geral
{
    protected $table = 'pedidos';
    protected $primaryKey = 'idpedido';
    protected $fillable = ['idagendamento', 'idendereco', 'idpessoa', 'datahora', 'previsao', 'valor', 'observacoes', 'status'];
    protected $guarded = ['idpedido'];
    protected $appends = ['etapa', 'ordem', 'status_formatado', 'pessoa_nome'];
    protected $dates = ['datahora', 'previsao'];
    public $with = ['pessoa.endereco', 'pedidos_itens', 'pedidos_ordem.etapa', 'lancamento'];

    public function pedidos_itens()
    {
        return $this->hasMany(Pedidos_itens::class, 'idpedido', 'idpedido');
    }

    public function pessoa()
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

    public function lancamento() {
        return $this->hasOne(Lancamentos::class, 'idpedido', 'idpedido');
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

    public function getPessoaNomeAttribute() {
        return $this->pessoa->nome;
    }

    public function setDatahoraAttribute($value) {
        return $this->attributes['datahora'] = Carbon::parse($value);
    }

    public function setPrevisaoAttribute($value) {
        return $this->attributes['previsao'] = Carbon::parse($value);

    }

}
