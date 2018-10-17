<?php

namespace App\Models;

class Enderecos extends Geral
{
    protected $table = 'enderecos';
    protected $primaryKey = 'idendereco';
    protected $fillable = ['idbairro', 'idcidade', 'endereco', 'numero', 'complemento', 'cep'];
    protected $guarded = ['idendereco'];
    public $with = ['cidade', 'bairro'];

    public function cidade()
    {
        return $this->hasOne(Cidades::class, 'idcidade', 'idcidade');
    }

    public function bairro()
    {
        return $this->hasOne(Bairros::class, 'idbairro', 'idbairro');
    }

    public function pessoa()
    {
        return $this->hasMany(Pessoas::class, 'idendereco', 'idendereco');
    }

    public function pedido()
    {
        return $this->hasMany(Pedidos::class, 'idendereco', 'idendereco');
    }

    public function scopeCadastro($query, $dados)
    {
        if (is_null($dados['idcidade']) && !empty($dados['cidade'])) {
            $dados['idcidade'] = Cidades::firstOrCreate(['nome' => $dados['cidade']])->idcidade;
        }
        if (is_null($dados['idbairro']) && !empty($dados['bairro'])) {
            $dados['idbairro'] = Bairros::firstOrCreate(['nome' => $dados['bairro']])->idbairro;
        }
        $endereco = new Enderecos();
        $novo = [];
        foreach ($endereco->getFillable() as $col) {
            $novo[$col] = $dados[$col];
        }
        return $novo;
    }
}
