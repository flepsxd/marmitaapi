<?php

namespace App\Http\Controllers;

use App\Models\Pedidos_itens;
use Illuminate\Http\Request;

class PedidosItensController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index(Request $request)
    {

        return resposta(Pedidos_itens::filtrar($request)->loadGet(true));
    }

    public function show(Request $request, $id)
    {
        return resposta(Pedidos_itens::loadGet()->find($id));
    }

    public function update(Request $request, $id)
    {
        $model = Pedidos_itens::find($id);
        $model->fill($request->all());
        $model->save();
        return resposta($model);
    }

    public function create(Request $request)
    {
        $model = new Pedidos_itens;
        $model->fill($request->all());
        $model->save();
        return resposta($model);
    }

    public function delete(Request $request, $id)
    {
        $model = Pedidos_itens::find($id);
        if ($model) {
            return resposta($model->delete());
        }
        return resposta([]);
    }

    public function byPedido(Request $request, $idpedido)
    {
        return resposta(Pedidos_itens::where('idpedido', '=', $idpedido)->with('produto')->get());
    }

}
