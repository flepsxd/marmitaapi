<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enderecos extends Model
{
    protected $table = 'enderecos';
    protected $primaryKey = 'idendereco';
    protected $fillable = [ 'idpessoa', 'idbairro', 'idcidade', 'endereco', 'numero', 'complemento', 'cep'];
    protected $guarded = ['idendereco'];
}
