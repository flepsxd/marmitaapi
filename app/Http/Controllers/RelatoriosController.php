<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produtos;
use App\Models\Pessoas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RelatoriosController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index(Request $request)
    {
        $perini = Carbon::parse(json_decode(@$request->input('filter'))->perini);
        $perfim = Carbon::parse(json_decode(@$request->input('filter'))->perfim);
        $amanha = $perini->isTomorrow();
        $futuro = $perini->isFuture();
        $tipo = json_decode(@$request->input('filter'))->tipo;
        $retorno = [];
        if ($tipo == 'produtos') {
            $dados = Produtos::filtrar($request)->whereHas('pedidos', function($query) use ($perini, $perfim, $request) {
                $query->whereBetween('datahora', array($perini, $perfim));
                $query->has('lancamento');
                $query->filtrar($request);
            })->with(['pedidos' => function($query) use ($perini, $perfim, $request) {
                $query->whereBetween('datahora', array($perini, $perfim));
                $query->has('lancamento');
                $query->filtrar($request);
            }]);
            
        } else {
            $dados = Pessoas::filtrar($request)->whereHas('pedidos', function($query) use ($perini, $perfim, $request) {
                $query->whereBetween('datahora', array($perini, $perfim));
                $query->has('lancamento');
                $query->filtrar($request);
            })->with(['pedidos' => function($query) use ($perini, $perfim, $request) {
                $query->whereBetween('datahora', array($perini, $perfim));
                $query->has('lancamento');
                $query->filtrar($request);
            }]);
        }
        $dados->each(function($q) {
            $q->append('items');
        });
        foreach($dados->get() as $dado) {
            $dado->valor = 0;
            $dado->quantidade = 0;
            $dado->qntdpedido = 0;
            $children = [];
            foreach($dado->items as $item) {
                $dado->valor += $item['valor'];
                $dado->quantidade += $item['quantidade'];
                $dado->qntdpedido += $item['qntdpedido'];
                $children[] = $item;
            }
            unset($dado->pedidos_itens);
            unset($dado->pedidos);
            unset($dado->items);
            $dado->children = $children;
            $retorno[] = $dado;
        };

        
        

        return resposta($retorno);
    }

}
