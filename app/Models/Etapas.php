<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etapas extends Model
{
    protected $table = 'etapas';
    protected $primaryKey = 'idetapa';
    protected $fillable = ['etapa', 'descricao'];
    protected $guarded = ['idetapa'];

    public function pedidos_ordem()
    {
        return $this->belongsTo(Pedidos_ordem::class, 'idetapa', 'idetapa');
    }
}
