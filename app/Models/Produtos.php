<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'idproduto';
    protected $fillable = ['descricao', 'preco', 'status'];
    protected $guarded = ['idproduto'];

    public function pedidos_itens()
    {
        return $this->belongsToMany(Pedidos_itens::class, 'idproduto', 'idproduto');
    }

    public function agendamentos_itens()
    {
        return $this->belongsToMany(Agendamentos_itens::class, 'idproduto', 'idproduto');
    }
}
