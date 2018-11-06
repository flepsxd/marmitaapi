<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdutosController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index(Request $request)
    {
        return resposta(Produtos::filtrar($request)->get());
    }

    public function show(Request $request, $id)
    {
        return resposta(Produtos::find($id));
    }

    public function update(Request $request, $id)
    {
        $model = Produtos::find($id);
        $model->fill($request->all());
        $model->save();
        return resposta($model);
    }

    public function create(Request $request)
    {
        $model = new Produtos;
        $model->fill($request->all());
        $model->save();
        return resposta($model);
    }

    public function delete(Request $request, $id)
    {
        $produto = Produtos::doesntHave('pedidos_itens', 'and', function($query) use ($id) {
                        $query->where('idproduto', $id);
                    });
        if(!$produto) {
            $produto = Produtos::doesntHave('agendamentos_itens', 'and', function($query) use ($id) {
                $query->where('idproduto', $id);
            });
        }
        if ($produto) {
            return resposta(null, ['idproduto' => 'Produto vinculado a um pedido ou agendamento'], 422);
        }
            

        $model = Produtos::find($id);       
        if ($model) {
            return resposta($model->delete());
        }
        return resposta([]);
    }

}
