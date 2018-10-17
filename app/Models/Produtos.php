<?php

namespace App\Models;

class Produtos extends Geral
{
    protected $table = 'produtos';
    protected $primaryKey = 'idproduto';
    protected $fillable = ['descricao', 'preco', 'status'];
    protected $guarded = ['idproduto'];
    protected $appends = ['status_formatado'];

    public function pedidos_itens()
    {
        return $this->belongsToMany(Pedidos_itens::class, 'idproduto', 'idproduto');
    }

    public function agendamentos_itens()
    {
        return $this->belongsToMany(Agendamentos_itens::class, 'idproduto', 'idproduto');
    }

    public function getPrecoAttribute() {
        return (float) $this->attributes['preco'];
    }

    public function getStatusFormatadoAttribute() {
        return $this->status == 'A' ? 'Ativo' : 'Inativo';
    }
}
