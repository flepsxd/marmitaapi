<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lancamentos extends Model
{
    protected $table = 'lancamentos';
    protected $primaryKey = 'idlancamento';
    protected $fillable = [ 'idpessoa', 'idpedido', 'valor', 'datahora', 'valorpago', 'datapagto'];
    protected $guarded = ['idlancamento'];
}
