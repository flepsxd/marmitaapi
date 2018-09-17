<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamentos_itens extends Model
{
    protected $table = 'agendamentos_itens';
    protected $primaryKey = 'idagendamento_item';
    protected $fillable = [ 'idagendamento', 'idproduto', 'quantidade'];
    protected $guarded = ['idagendamento_item'];
}
