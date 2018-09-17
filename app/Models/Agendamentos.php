<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamentos extends Model
{
    protected $table = 'agendamentos';
    protected $primaryKey = 'idagendamento';
    protected $fillable = [ 'idpessoa', 'status' ];
    protected $guarded = ['idagendamento'];
}
