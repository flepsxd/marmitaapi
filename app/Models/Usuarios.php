<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;

class Usuarios extends Geral
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $fillable = [ 'nome', 'email', 'senha', 'status' ];
    protected $guarded = ['id'];
    protected $hidden = [ 'senha' ];
    protected $calculados = ['status_formatado'];

    public function setSenhaAttribute($value) {
        $this->attributes['senha'] = Hash::make($value);
    }

    public function getStatusFormatadoAttribute($value) {
        return $this->status == 'A' ? 'Ativo' : 'Inativo';
    }
}
