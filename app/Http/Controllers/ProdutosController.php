<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;

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
        $model = Produtos::find($id);
        if ($model) {
            return resposta($model->delete());
        }
        return resposta([]);
    }

}
