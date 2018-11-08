<?php

namespace App\Http\Controllers;

use App\Models\Etapas;
use Illuminate\Http\Request;

class EtapasController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index(Request $request)
    {
        return resposta(Etapas::filtrar($request)->loadGet(true));
    }

    public function show(Request $request, $id)
    {
        return resposta(Etapas::loadGet()->find($id));
    }

    public function update(Request $request, $id)
    {
        $model = Etapas::find($id);
        $model->fill($request->all());
        $model->save();
        return resposta($model);
    }

    public function create(Request $request)
    {
        $model = new Etapas;
        $model->fill($request->all());
        $model->save();
        return resposta($model);
    }

    public function delete(Request $request, $id)
    {
        $model = Etapas::find($id);
        if ($model) {
            return resposta($model->delete());
        }
        return resposta([]);
    }

}
