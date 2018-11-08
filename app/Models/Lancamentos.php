<?php

namespace App\Models;

class Lancamentos extends Geral
{
    protected $table = 'lancamentos';
    protected $primaryKey = 'idlancamento';
    protected $fillable = ['idpessoa', 'idpedido', 'valor', 'datahora', 'valorpago', 'datapagto'];
    protected $guarded = ['idlancamento'];
    protected $calculados = ['pessoa_nome'];
    public $dependencias = ['pessoa'];

    public function pedidos()
    {
        return $this->belongsTo(Pedidos::class, 'idpedido', 'idpedido');
    }

    public function pessoas()
    {
        return $this->belongsTo(Pessoas::class, 'idpessoa', 'idpessoa');
    }

    public function pessoa() {
        return $this->hasOne(Pessoas::class, 'idpessoa', 'idpessoa');
    }

    public function getPessoaNomeAttribute()
    {
        return $this->pessoa->nome;
    }
}
