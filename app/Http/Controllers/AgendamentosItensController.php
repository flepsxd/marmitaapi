<?php

namespace App\Http\Controllers;

use App\Models\Agendamentos_itens;
use Illuminate\Http\Request;

class AgendamentosItensController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth');
    }
        
    public function index(Request $request){
        return resposta(Agendamentos_itens::filtrar($request)->loadGet(true));
    }

    public function show(Request $request, $id){
        return resposta(Agendamentos_itens::loadGet()->find($id));
    }

    public function update(Request $request, $id){
        $model = Agendamentos_itens::find($id);
        $model->fill($request->all());
        $model->save();
        return resposta($model);   
    }

    public function create(Request $request){
        $model = new Agendamentos_itens;
        $model->fill($request->all());
        $model->save();
        return resposta($model);    
    }

    public function delete(Request $request, $id){
        $model = Agendamentos_itens::find($id);
        if ($model){
            return resposta($model->delete());
        }
        return resposta([]);
    }

}
