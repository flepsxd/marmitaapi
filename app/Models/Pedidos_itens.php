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
        return $this->belongsTo(Pedidos::class, 'idpedido', 'idpedido');
    }

    public function produto()
    {
        return $this->hasOne(Produtos::class, 'idproduto', 'idproduto');
    }
}
