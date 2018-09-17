<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bairros extends Model
{
    protected $table = 'bairros';
    protected $primaryKey = 'idbairro';
    protected $fillable = [ 'nome' ];
    protected $guarded = ['idcidade'];
}
