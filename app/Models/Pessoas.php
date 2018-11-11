<?php

namespace App\Models;

class Pessoas extends Geral
{
    protected $table = 'pessoas';
    protected $primaryKey = 'idpessoa';
    protected $fillable = ['nome', 'telefone', 'email', 'status', 'idendereco'];
    protected $guarded = ['idpessoa'];
    public $appends = ['status_formatado'];
    public $dependencias = ['endereco'];

    public function pedidos()
    {
        return $this->hasMany(Pedidos::class, 'idpessoa', 'idpessoa');
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamentos::class, 'idpessoa', 'idpessoa');
    }

    public function endereco()
    {
        return $this->hasOne(Enderecos::class, 'idendereco', 'idendereco');
    }

    public function getStatusFormatadoAttribute() {
        return $this->status == 'A' ? 'Ativo' : 'Inativo';
    }

    public function getItemsAttribute() {
        $items = [];
        foreach($this->pedidos as $pedido) {
            $pedidos_itens = $pedido->pedidos_itens;
            foreach($pedidos_itens as $pedido_item) {
                $item = @$items[$pedido_item->idproduto];
                if(!$item) {
                    $item = [
                        'produto' => $pedido_item->produto->descricao,
                        'valor' => 0,
                        'quantidade' => 0,
                        'qntdpedido' => 0,
                        'status_formatado' => $pedido_item->produto->status_formatado
                    ];
                }
                $item['valor'] += floatval($pedido_item->vlrtotal);
                $item['quantidade'] += floatval($pedido_item->quantidade);
                $item['qntdpedido'] += 1;
                $items[$pedido_item->idproduto] = $item;
            }
        }
        return $items;
    }
}
