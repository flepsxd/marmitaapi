<?php

namespace App\Models;

class Agendamentos extends Geral
{
    protected $table = 'agendamentos';
    protected $primaryKey = 'idagendamento';
    protected $fillable = [ 'idpessoa', 'status' ];
    protected $guarded = ['idagendamento'];
}
