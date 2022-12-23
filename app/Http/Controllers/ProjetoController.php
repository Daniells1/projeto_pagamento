<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projeto;
use Illuminate\Support\Facades\Validator;

class ProjetoController extends Controller
{
    public function index(Request $request){
        $data = [];

        if($request->isMethod("POST") ){

            $validator = Validator::make($request->all(), [
                'nome' => 'required|unique:projetos|max:40'
            ], [
                'nome.required' => 'Preencha o campo nome',
                'nome.unique' => 'Projeto já cadastrado',
                'nome.max' => 'Máximo de 40 caracteres para o projeto'
            ]);
            
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            };

            $projeto = new Projeto($request->all());

            $projeto->save();

        }

        $data["lista"] = Projeto::all();

        return view('projeto/index', $data);

    }
   
}
