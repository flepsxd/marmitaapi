<?php

namespace App\Models;

class Produtos extends Geral
{
    protected $table = 'produtos';
    protected $primaryKey = 'idproduto';
    protected $fillable = ['descricao', 'preco', 'status'];
    protected $guarded = ['idproduto'];
    public $appends = ['status_formatado'];

    public function pedidos_itens()
    {
        return $this->hasMany(Pedidos_itens::class, 'idproduto', 'idproduto');
    }

    public function pedidos() {
        return $this->hasManyThrough(Pedidos::class, Pedidos_itens::class, 'idproduto', 'idpedido', 'idproduto', 'idpedido');
    }

    public function agendamentos_itens()
    {
        return $this->hasMany(Agendamentos_itens::class, 'idproduto', 'idproduto');
    }
    
    public function getPrecoAttribute() {
        return (float) $this->attributes['preco'];
    }

    public function getStatusFormatadoAttribute() {
        return $this->status == 'A' ? 'Ativo' : 'Inativo';
    }

    public function getItemsAttribute() {
        $items = [];
        $idproduto = $this->idproduto;
        foreach($this->pedidos as $pedido) {
            $pedidos_itens = $pedido->pedidos_itens->filter(function($pedido_item) use ($idproduto) {
                return $pedido_item->idproduto == $idproduto;
            });
            $item = @$items[$pedido->idpessoa];
            foreach($pedidos_itens as $pedido_itens) {
                if(!$item) {
                    $item = [
                        'pessoa' => $pedido->pessoa_nome,
                        'valor' => 0,
                        'quantidade' => 0,
                        'qntdpedido' => 0,
                        'status_formatado' => $pedido->pessoa->status_formatado
                    ];
                }
                $item['valor'] += floatval($pedido_itens->vlrtotal);
                $item['quantidade'] += floatval($pedido_itens->quantidade);
                $item['qntdpedido'] += 1;
            }
            $items[$pedido->idpessoa] = $item;
        }
        return $items;
    }
}
