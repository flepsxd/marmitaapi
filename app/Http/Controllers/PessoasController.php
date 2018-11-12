<?php

namespace App\Http\Controllers;

use App\Models\Pessoas;
use App\Models\Enderecos;
use App\Models\Pedidos;
use App\Models\Agendamentos;
use Illuminate\Http\Request;

class PessoasController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index(Request $request)
    {
        return resposta(Pessoas::filtrar($request)->loadGet(true));
    }

    public function show(Request $request, $id)
    {
        return resposta(Pessoas::loadGet()->find($id));
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
        $pessoa = Pedidos::where('idpessoa', $id)->first();
        if(!$pessoa) {
            $pessoa = Agendamentos::where('idpessoa', $id)->get()->first();
        }
        if ($pessoa) {
            return resposta(null, ['idpessoa' => 'Pessoa vinculada a um pedido ou agendamento'], 422);
        }
        $model = Pessoas::find($id);
        if ($model) {
            return resposta($model->delete());
        }
        return resposta([]);
    }

}
