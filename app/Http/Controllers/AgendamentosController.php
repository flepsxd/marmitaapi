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
        $model->fill($request->all());
        $model->save();
        return resposta($model);   
    }

    public function create(Request $request){
        $model = new Agendamentos;
        $model->fill($request->all());
        $model->save();
        return resposta($model);    
    }

    public function delete(Request $request, $id){
        $model = Agendamentos::find($id);
        if ($model){
            return resposta($model->delete());
        }
        return resposta([]);
    }

}
