<?php

namespace App\Models;

class Pedidos_ordem extends Geral
{
    protected $table = 'pedidos_ordem';
    protected $primaryKey = 'idpedido_ordem';
    protected $fillable = ['idpedido', 'ordem', 'idetapa'];
    protected $guarded = ['idpedido_ordem'];

    public function pedido()
    {
        return $this->belongsTo(Pedidos::class, 'idpedido', 'idpedido');
    }

    public function etapa()
    {
        return $this->hasOne(Etapas::class, 'idetapa', 'idetapa');
    }

    public function scopeOrdenar($query, $idpedido_ordem, $novaOrdem, $novaEtapa)
    {
        $pedidos_ordem = $this->find($idpedido_ordem);
        $antigaEtapa = $pedidos_ordem->idetapa;
        $antigaOrdem = $pedidos_ordem->ordem;
        $pedidos_ordem->fill(['ordem' => $novaOrdem, 'idetapa' => $novaEtapa]);
        $pedidos_ordem->save();
        sleep(1);
        $this->ajustaOrdem($antigaEtapa);
        if ($antigaEtapa != $novaEtapa) {
            $this->ajustaOrdem($novaEtapa);
        }

        return $query;
    }
    function ajustaOrdem($etapa)
    {
        $listaPedidos = Pedidos_ordem::where('idetapa', $etapa)->orderBy('ordem')->orderBy('updated_at', 'desc')->get();
        foreach ($listaPedidos as $key => $pedido) {
            $pedido->timestamps = false;
            $pedido->fill(['ordem' => $key]);
            $pedido->save();
        }
    }
}
