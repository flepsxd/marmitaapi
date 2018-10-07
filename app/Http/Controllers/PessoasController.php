<?php

namespace App\Http\Controllers;

use App\Models\Pessoas;
use Illuminate\Http\Request;

class PessoasController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index(Request $request)
    {
        $ativo = $request->input('ativo');
        if (is_null($ativo)) {
            return resposta(Pessoas::all());
        } else {
            return resposta(Pessoas::where('status', '=', ($ativo == "true" ? 'A' : 'I'))->get());
        }
    }

    public function show(Request $request, $id)
    {
        return resposta(Pessoas::find($id));
    }

    public function update(Request $request, $id)
    {
        $model = Pessoas::find($id);
        $model->fill($request->all());
        $model->save();
        return resposta($model);
    }

    public function create(Request $request)
    {
        $model = new Pessoas;
        $model->fill($request->all());
        $model->save();
        return resposta($model);
    }

    public function delete(Request $request, $id)
    {
        $model = Pessoas::find($id);
        if ($model) {
            return resposta($model->delete());
        }
        return resposta([]);
    }

}
