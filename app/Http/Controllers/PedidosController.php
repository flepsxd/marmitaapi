<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\Etapas;
use App\Models\Pedidos_ordem;
use App\Models\Enderecos;
use App\Models\Pedidos_itens;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index(Request $request)
    {
        return resposta(Pedidos::filtrar($request)->get());
    }

    public function show(Request $request, $id)
    {
        return resposta(Pedidos::find($id));
    }

    public function update(Request $request, $id)
    {
        $model = Pedidos::find($id);
        $dados = $request->all();
        if (isset($dados['ordem']) && isset($dados['etapa'])) {
            if ($dados['ordem'] != $model->pedidos_ordem->ordem && $dados['etapa'] != $model->pedidos_ordem->idetapa) {
                $model->pedidos_ordem()->ordenar($request->pedidos_ordem['idpedido_ordem'], $dados['ordem'], $dados['etapa']);
            }
        }
        $dadosAtualizar = [];
        $pedidos = new Pedidos();
        foreach ($pedidos->getFillable() as $coluna) {
            $dadosAtualizar[$coluna] = @$dados[$coluna];
        }
        $model->fill($dadosAtualizar);
        $endereco = Enderecos::cadastro($dados['endereco']);
        $model->endereco()->update($endereco);
        $model->save();

        foreach ($dados['pedidos_itens'] as $pedido_item) {
            $model->pedidos_itens()->updateOrCreate(['idpedido_item' => $pedido_item['idpedido_item']], $pedido_item);
        }

        return resposta(Pedidos::find($id));
    }

    public function create(Request $request)
    {
        $dados = $request->all();

        $pedido = new Pedidos($dados);
        $endereco = Enderecos::cadastro($dados['endereco']);
        $pedido->endereco()->create($endereco);
        $pedido->save();

        $pedidos_ordem = new Pedidos_ordem([
            'idetapa' => 1,
            'ordem' => (Pedidos_ordem::where('idetapa', 1)->max('ordem') + 1)
        ]);
        $pedidos_ordem->pedido()->associate($pedido);
        $pedidos_ordem->save();

        $pedido->pedidos_itens()->createMany($dados['pedidos_itens']);

        return resposta(Pedidos::find($pedido->idpedido));
    }

    public function delete(Request $request, $id)
    {
        $model = Pedidos::find($id);
        if ($model) {
            return resposta($model->delete());
        }
        return resposta([]);
    }

    public function timeline(Request $request)
    {
        $novaTimeline = [];
        $model = Pedidos::filtrar($request)->get()->groupBy('pedidos_ordem.idetapa');
        $etapas = Etapas::all();
        foreach ($etapas as $etapa) {
            $pedidos = clone $model[$etapa->idetapa];
            $pedidos = $pedidos->sortBy(function ($val) {
                return $val->ordem;
            });

            $novaTimeline[] = [
                'header' => $etapa->descricao,
                'filtro' => $etapa->etapa,
                'idetapa' => $etapa->idetapa,
                'dados' => $pedidos->values()
            ];
        }
        return resposta($novaTimeline);
    }

}
