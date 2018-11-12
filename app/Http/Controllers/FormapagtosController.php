<?php

namespace App\Http\Controllers;

use App\Models\Formapagtos;
use Illuminate\Http\Request;

class FormapagtosController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index(Request $request)
    {
        return resposta(Formapagtos::filtrar($request)->loadGet(true));
    }

    public function show(Request $request, $id)
    {
        return resposta(Formapagtos::loadGet()->find($id));
    }

    public function update(Request $request, $id)
    {
        $model = Formapagtos::find($id);
        $model->fill($request->all());
        $model->save();
        return resposta($model);
    }

    public function create(Request $request)
    {
        $model = new Formapagtos;
        $model->fill($request->all());
        $model->save();
        return resposta($model);
    }

    public function delete(Request $request, $id)
    {
        $model = Formapagtos::find($id);
        if ($model) {
            return resposta($model->delete());
        }
        return resposta([]);
    }

}
