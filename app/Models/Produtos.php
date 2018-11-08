<?php

namespace App\Models;

class Produtos extends Geral
{
    protected $table = 'produtos';
    protected $primaryKey = 'idproduto';
    protected $fillable = ['descricao', 'preco', 'status'];
    protected $guarded = ['idproduto'];
    protected $calculados = ['status_formatado'];

    public function pedidos_itens()
    {
        return $this->hasMany(Pedidos_itens::class, 'idproduto', 'idproduto');
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
        foreach($this->pedidos_itens as $pedido_itens) {
            $pedido_itens->with('pedido');
            $item = @$items[$pedido_itens->pedido->idpessoa];
            if(!$item) {
                $item = [
                    'pessoa' => $pedido_itens->pedido->pessoa_nome,
                    'valor' => 0,
                    'quantidade' => 0,
                    'status_formatado' => $pedido_itens->pedido->pessoa->status_formatado
                ];
            }
            $item['valor'] = $item['valor'] + floatval($pedido_itens->vlrtotal);
            $item['quantidade'] = $item['quantidade'] + floatval($pedido_itens->quantidade);
            $items[$pedido_itens->pedido->idpessoa] = $item;
        }
        return $items;
    }
}
