<?php

namespace App\Http\Controllers;

use App\Models\Bairros;
use Illuminate\Http\Request;

class BairrosController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth');
    }
        
    public function index(Request $request){
        return resposta(Bairros::all());
    }

    public function show(Request $request, $id){
        return resposta(Bairros::find($id));
    }

    public function update(Request $request, $id){
        $model = Bairros::find($id);
        $model->fill($request->all());
        $model->save();
        return resposta($model);   
    }

    public function create(Request $request){
        $model = new Bairros;
        $model->fill($request->all());
        $model->save();
        return resposta($model);    
    }

    public function delete(Request $request, $id){
        $model = Bairros::find($id);
        if ($model){
            return resposta($model->delete());
        }
        return resposta([]);
    }

}
