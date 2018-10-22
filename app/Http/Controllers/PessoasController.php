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
        $pessoas = Pessoas::filtrar($request);
        return resposta($pessoas->get());
    }

    public function show(Request $request, $id)
    {
        return resposta(Pessoas::find($id));
    }

    public function update(Request $request, $id)
    {
        $model = Pessoas::find($id);
        $dados = $request->all();
        if (array_has($dados, 'endereco')) {
            $dadosEndereco = Enderecos::cadastro($dados['endereco']);
            Enderecos::updateOrCreate($dadosEndereco);
        }
        $model->fill($dados);
        $model->save();
        return resposta(Pessoas::find($id));
    }

    public function create(Request $request)
    {
        $dados = $request->all();

        $pessoa = new Pessoas;
        $endereco = Enderecos::cadastro($dados['endereco']);
        $idendereco = Enderecos::create($endereco)->idendereco;
        $dados['idendereco'] = $idendereco;
        $pessoa->fill($dados);
        $pessoa->save();
        return resposta(Pessoas::findOrFail($pessoa->idpessoa));
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
