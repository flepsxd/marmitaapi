<?php

namespace App\Http\Controllers;

use App\Models\Cidades;
use Illuminate\Http\Request;

class CidadesController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth');
    }
        
    public function index(Request $request){
        return resposta(Cidades::all());
    }

    public function show(Request $request, $id){
        return resposta(Cidades::find($id));
    }

    public function update(Request $request, $id){
        $model = Cidades::find($id);
        $model->fill($request->all());
        $model->save();
        return resposta($model);   
    }

    public function create(Request $request){
        $model = new Cidades;
        $model->fill($request->all());
        $model->save();
        return resposta($model);    
    }

    public function delete(Request $request, $id){
        $model = Cidades::find($id);
        if ($model){
            return resposta($model->delete());
        }
        return resposta([]);
    }

}
