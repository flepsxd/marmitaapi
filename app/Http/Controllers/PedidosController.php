<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index(Request $request)
    {
        return resposta(Pedidos::with('pessoas', 'pedidos_itens.produto')->get());
    }

    public function show(Request $request, $id)
    {
        return resposta(Pedidos::where('idpedido', '=', $id)->with('pessoas', 'pedidos_itens.produto')->first());
    }

    public function update(Request $request, $id)
    {
        $model = Pedidos::find($id);
        $model->fill($request->all());
        $model->save();
        return resposta($model);
    }

    public function create(Request $request)
    {
        $model = new Pedidos;
        $model->fill($request->all());
        $model->save();
        return resposta($model);
    }

    public function delete(Request $request, $id)
    {
        $model = Pedidos::find($id);
        if ($model) {
            return resposta($model->delete());
        }
        return resposta([]);
    }

}
