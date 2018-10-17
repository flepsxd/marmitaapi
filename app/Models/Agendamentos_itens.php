<?php

namespace App\Models;

class Agendamentos_itens extends Geral
{
    protected $table = 'agendamentos_itens';
    protected $primaryKey = 'idagendamento_item';
    protected $fillable = ['idagendamento', 'idproduto', 'quantidade'];
    protected $guarded = ['idagendamento_item'];

    public function agendamentos()
    {
        return $this->belongsTo(App\Models\Agendamentos::class);
    }

    public function produtos()
    {
        return $this->belongsTo(App\Models\Produtos::class);
    }
}
