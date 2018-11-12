<?php

namespace App\Models;

use Carbon\Carbon;

class Agendamentos extends Geral
{
    protected $table = 'agendamentos';
    protected $primaryKey = 'idagendamento';
    protected $fillable = [ 'idpessoa', 'status', 'idpessoa', 'hora', 'previsao', 'valor', 'observacoes', 'status', 'idformapagto'];
    protected $guarded = ['idagendamento'];
    protected $appends = ['formapagtodesc'];
    protected $calculados = ['pessoa_nome'];
    public $dependencias = ['agendamento_itens', 'pessoa', 'formapagto'];

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

    public function formapagto() 
    {
        return $this->hasOne(Formapagtos::class, 'idformapagto', 'idformapagto');
    }

    public function getFormapagtodescAttribute()
    {
        return $this->formapagto->descricao;
    }

    public function getPessoaNomeAttribute()
    {
        return $this->pessoa->nome;
    }

    public function scopeProximosAgendamentos($query, $datahora) {
        $datahora = Carbon::parse($datahora);
        $amanha = $datahora->isTomorrow();
        $futuro = $datahora->isFuture();
        if ($futuro) {
            $agendamentos = Agendamentos::when($amanha, function($query) {
                $query->where('proximodia', true);
            });
            return $agendamentos = $agendamentos
                ->where('status', 'A');
        } else {
            return Agendamentos::whereRaw('0=1');
        }
    }

    public static function geraPedidos() 
    {
        $agendamentosHoje = Agendamentos::where('proximodia', true)
                ->where('status', 'A')
                ->doesntHave('pedido', 'and', function($query) {
                    $data = Carbon::now()->toDateString();
                    $query->whereDate('datahora', $data);
                })
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
                'idformapagto' => $agendamento->idformapagto,
                'status' => 'A'
            ]);
            $itens = $itens->map(function($item) {
                unset($item->idagendamento);
                return $item;
            });
            $pedido->pedidos_itens()->createMany($itens->toArray());
            $pedido->save();
        }
        $agendamentos = Agendamentos::where('proximodia', false);
        foreach($agendamentos as $agendamento) {
            $agendamento->fill(['proximodia'=> true]);
            $agendamento->save();
        }
        
    }
}
