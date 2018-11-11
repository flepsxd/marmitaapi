<?php

namespace App\Models;

class Pedidos_itens extends Geral
{
    protected $table = 'pedidos_itens';
    protected $primaryKey = 'idpedido_item';
    protected $fillable = ['idpedido', 'idproduto', 'vlrunitario', 'quantidade', 'vlrtotal', 'desconto'];
    protected $guarded = ['idpedido_item'];
    public $with = ['produto'];

    public function pedido()
    {
        return $this->hasOne(Pedidos::class, 'idpedido', 'idpedido');
    }

    public function produto()
    {
        return $this->hasOne(Produtos::class, 'idproduto', 'idproduto');
    }

    public static function posAtualizar($model) {
        static::atualizarValor($model);
    }

    public static function posAdicionar($model) {
        static::atualizarValor($model);
    }
    
    public static function atualizarValor($item) {
        $pedido = Pedidos::find($item->idpedido);
        $itens = $pedido->pedidos_itens;
        $valor = $itens->sum(function($val) { return $val->vlrtotal; });
        $pedido->fill(['valor'=>$valor]);
        $pedido->save();
    } 
}
