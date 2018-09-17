<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoas extends Model
{
    protected $table = 'pessoas';
    protected $primaryKey = 'idpessoa';
    protected $fillable = [ 'nome', 'telefone', 'email', 'status' ];
    protected $guarded = ['idpessoa'];
}
