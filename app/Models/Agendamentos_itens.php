<?php

namespace App\Models;

class Agendamentos_itens extends Geral
{
    protected $table = 'agendamentos_itens';
    protected $primaryKey = 'idagendamento_item';
    protected $fillable = ['idagendamento', 'idproduto', 'vlrunitario', 'quantidade', 'vlrtotal', 'desconto'];
    protected $guarded = ['idagendamento_item'];
    public $with = ['produto'];

    public function agendamento()
    {
        return $this->belongsTo(Agendamentos::class, 'idagendamento', 'idagendamento');
    }

    public function produto()
    {
        return $this->hasOne(Produtos::class, 'idproduto', 'idproduto');
    }

    public static function posAtualizar($model) {
        self::atualizarValor($model);
    }

    public static function posAdicionar($model) {
        self::atualizarValor($model);
    }
    
    public static function atualizarValor($item) {
        $agendamento = Agendamentos::find($item->idagendamento);
        $itens = $agendamento->agendamento_itens;
        $valor = $itens->sum(function($val) { return $val->vlrtotal; });
        $agendamento->fill(['valor'=>$valor]);
        $agendamento->save();
    } 
}
