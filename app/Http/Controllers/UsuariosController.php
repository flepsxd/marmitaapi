<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Http\Controllers\Controller;

class UsuariosController extends Controller
{
    public function __construct(){
        $this->middleware('jwt.auth');
    }
    
    public function index(Request $request){
        return resposta(Usuarios::filtrar($request)->get());
    }

    public function show(Request $request, $id){
        return resposta(Usuarios::find($id));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'nome' => 'required|unique:usuarios,nome,'.$id,
            'email' => 'required|email|unique:usuarios,email,'.$id,
            'senha' => 'required|min:6'
        ]);
        $model = Usuarios::find($id);
        $model->fill($request->all());
        $model->save();
        return resposta($model);   
    }

    public function create(Request $request){
        $this->validate($request, [
            'nome' => 'required|unique:usuarios,nome',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|min:6'
        ]);
        $model = new Usuarios;
        $model->fill($request->all());
        $model->save();
        return resposta($model);    
    }

    public function delete(Request $request, $id){
        $model = Usuarios::find($id);
        if ($model){
            return resposta($model->delete());
        }
        return resposta([]);
    }
}
