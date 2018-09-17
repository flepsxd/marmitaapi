<?php

namespace App\Http\Controllers;

use App\Models\Lancamentos;
use Illuminate\Http\Request;

class LancamentosController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth');
    }
        
    public function index(Request $request){
        return resposta(Lancamentos::all());
    }

    public function show(Request $request, $id){
        return resposta(Lancamentos::find($id));
    }

    public function update(Request $request, $id){
        $model = Lancamentos::find($id);
        $model->fill($request->all());
        $model->save();
        return resposta($model);   
    }

    public function create(Request $request){
        $model = new Lancamentos;
        $model->fill($request->all());
        $model->save();
        return resposta($model);    
    }

    public function delete(Request $request, $id){
        $model = Lancamentos::find($id);
        if ($model){
            return resposta($model->delete());
        }
        return resposta([]);
    }

}
