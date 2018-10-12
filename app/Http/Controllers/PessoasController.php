<?php

namespace App\Http\Controllers;

use App\Models\Pessoas;
use App\Models\Enderecos;
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
        $dados = $request->all();
        $model->fill($dados);
        if ($request->endereco) {
            $endereco = Enderecos::cadastro($dados['endereco']);
            $model->endereco()->update($endereco);
        }
        $model->save();
        return resposta(Pessoas::find($id));
    }

    public function create(Request $request)
    {
        $dados = $request->all();

        $pessoa = new Pessoas($dados);
        $endereco = Enderecos::cadastro($dados['endereco']);
        $pessoa->endereco()->create($endereco);
        $pessoa->save();
        return resposta(Pessoas::find($pessoa->idpessoa));
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
