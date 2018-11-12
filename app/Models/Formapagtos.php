<?php

namespace App\Models;

class Formapagtos extends Geral
{
    protected $table = 'formapagtos';
    protected $primaryKey = 'idformapagto';
    protected $fillable = ['descricao'];
    protected $guarded = ['idformapagto'];
}
