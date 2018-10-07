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
        return $this->hasMany(Pedidos_itens::class, 'idpedido_item');
    }

    public function pessoas()
    {
        return $this->hasOne(Pessoas::class, 'idpessoa');
    }
}
