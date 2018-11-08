<?php

namespace App\Http\Controllers;

use App\Models\Enderecos;
use Illuminate\Http\Request;

class EnderecosController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth');
    }
        
    public function index(Request $request){
        return resposta(Enderecos::filtrar($request)->loadGet(true));
    }

    public function show(Request $request, $id){
        return resposta(Enderecos::loadGet()->find($id));
    }

    public function update(Request $request, $id){
        $model = Enderecos::find($id);
        $model->fill($request->all());
        $model->save();
        return resposta($model);   
    }

    public function create(Request $request){
        $model = new Enderecos;
        $model->fill($request->all());
        $model->save();
        return resposta($model);    
    }

    public function delete(Request $request, $id){
        $model = Enderecos::find($id);
        if ($model){
            return resposta($model->delete());
        }
        return resposta([]);
    }

}
