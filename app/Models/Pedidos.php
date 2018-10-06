<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'idpedido';
    protected $fillable = ['idagendamento', 'idpessoa', 'idendereco', 'datahora', 'etapa', 'valor', 'observacoes', 'status'];
    protected $guarded = ['idpedido'];

    public function pedidos_itens()
    {
        return $this->hasMany(App\Models\Pedidos_itens::class);
    }
}
