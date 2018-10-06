<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidades extends Model
{
    protected $table = 'cidades';
    protected $primaryKey = 'idcidade';
    protected $fillable = ['nome', 'uf'];
    protected $guarded = ['idcidade'];

    public function enderecos()
    {
        return $this->belongsTo(App\Models\Enderecos);
    }
}
