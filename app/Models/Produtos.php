<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'idproduto';
    protected $fillable = [ 'descricao', 'preco', 'status'];
    protected $guarded = ['idproduto'];
}
