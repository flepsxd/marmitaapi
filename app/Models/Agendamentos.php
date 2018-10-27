<?php

namespace App\Models;

use Carbon\Carbon;

class Agendamentos extends Geral
{
    protected $table = 'agendamentos';
    protected $primaryKey = 'idagendamento';
    protected $fillable = [ 'idpessoa', 'status', 'idpessoa', 'datahora', 'previsao', 'valor', 'observacoes', 'status' ];
    protected $guarded = ['idagendamento'];
    protected $appends = ['pessoa_nome'];
    public $with = ['agendamento_itens'];

    public function agendamento_itens()
    {
        return $this->hasMany(Agendamentos_itens::class, 'idagendamento', 'idagendamento');
    }

    public function pessoa()
    {
        return $this->hasOne(Pessoas::class, 'idpessoa', 'idpessoa');
    }

    public function pedido() 
    {
        return $this->hasMany(Pedidos::class, 'idagendamento', 'idagendamento');
    }

    public function getPessoaNomeAttribute()
    {
        return $this->pessoa->nome;
    }

    public static function geraPedidos() 
    {
        $agendamentosHoje = Agendamentos::where('proximodia', true)
                ->where('status', 'A')
                ->doesntHave('pedido')
                ->get();
        

        foreach($agendamentosHoje as $agendamento) {
            $itens = $agendamento->agendamento_itens;
            $valor = $itens->sum(function($val){return $val->vlrtotal;});
            $pedido = Pedidos::create([
                'idagendamento' => $agendamento->idagendamento,
                'datahora' => Carbon::now()->setTimeFromTimeString($agendamento->hora),
                'previsao' => Carbon::now()->setTimeFromTimeString($agendamento->previsao),
                'idpessoa' => $agendamento->idpessoa,
                'idendereco' => $agendamento->pessoa->idendereco,
                'valor' => $valor,
                'status' => 'A'
            ]);
            $itens = $itens->map(function($item) {
                unset($item->idagendamento);
                return $item;
            });
            $pedido->pedidos_itens()->createMany($itens->toArray());
            $pedido->save();
        }
        
    }
}
