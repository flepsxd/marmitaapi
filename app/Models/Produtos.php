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
        return $this->belongsToMany(App\Models\Pedidos_itens::class);
    }

    public function agendamentos_itens()
    {
        return $this->belongsToMany(App\Models\Agendamentos_itens::class);
    }
}
