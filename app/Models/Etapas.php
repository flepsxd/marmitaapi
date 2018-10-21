<?php

namespace App\Models;

class Etapas extends Geral
{
    protected $table = 'etapas';
    protected $primaryKey = 'idetapa';
    protected $fillable = ['etapa', 'descricao', 'finalizado', 'geralancamento'];
    protected $guarded = ['idetapa'];

    public function pedidos_ordem()
    {
        return $this->belongsTo(Pedidos_ordem::class, 'idetapa', 'idetapa');
    }
}
