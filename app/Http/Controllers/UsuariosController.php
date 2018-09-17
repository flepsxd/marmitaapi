<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;

class UsuariosController extends Controller
{
    public function __construct(){
        $this->middleware('jwt.auth');
    }
    
    public function index(Request $request){
        return resposta(Usuarios::all());
    }

    public function show(Request $request, $id){
        return resposta(Usuarios::find($id));
    }
}
