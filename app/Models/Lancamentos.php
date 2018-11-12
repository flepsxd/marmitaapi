<?php

namespace App\Models;

class Lancamentos extends Geral
{
    protected $table = 'lancamentos';
    protected $primaryKey = 'idlancamento';
    protected $fillable = ['idpessoa', 'idpedido', 'valor', 'datahora', 'valorpago', 'datapagto', 'idformapagto'];
    protected $guarded = ['idlancamento'];
    protected $appends = ['formapagtodesc'];
    protected $calculados = ['pessoa_nome'];
    public $dependencias = ['pessoa', 'formapagto'];

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

    public function formapagto() 
    {
        return $this->hasOne(Formapagtos::class, 'idformapagto', 'idformapagto');
    }

    public function getFormapagtodescAttribute()
    {
        return $this->formapagto->descricao;
    }

    public function getPessoaNomeAttribute()
    {
        return $this->pessoa->nome;
    }
}
