<?php

namespace App\Http\Controllers;

use App\Models\Agendamentos;
use Illuminate\Http\Request;

class AgendamentosController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth');
    }
        
    public function index(Request $request){
        return resposta(Agendamentos::all());
    }

    public function show(Request $request, $id){
        return resposta(Agendamentos::find($id));
    }

    public function update(Request $request, $id){
        $model = Agendamentos::find($id);
        $dados = $request->all();

        $dadosAtualizar = [];
        $agendamentos = new Agendamentos();
        foreach ($agendamentos->getFillable() as $coluna) {
            $dadosAtualizar[$coluna] = @$dados[$coluna];
        }
        $model->fill($dadosAtualizar);
        $model->save();

        foreach ($dados['agendamento_itens'] as $agendamento_item) {
            if(array_has($agendamento_item, 'deletar') && $agendamento_item['idagendamento_item']) {
                $model->agendamento_itens()->delete(['idagendamento_item' => $agendamento_item['idagendamento_item']]);
            } else {
                $model->agendamento_itens()->updateOrCreate(['idagendamento_item' => $agendamento_item['idagendamento_item']], $agendamento_item);
            }
        }

        return resposta(Agendamentos::find($id));
    }

    public function create(Request $request){
        $dados = $request->all();

        $agendamento = new Agendamentos;
        $agendamento->fill($dados);
        $agendamento->save();

        $agendamento->agendamento_itens()->createMany($dados['agendamento_itens']);

        return resposta(Agendamentos::findOrFail($agendamento->idpedido)); 
    }

    public function delete(Request $request, $id){
        $model = Agendamentos::find($id);
        if ($model){
            return resposta($model->delete());
        }
        return resposta([]);
    }

}
