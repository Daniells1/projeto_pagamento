<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use Illuminate\Support\Facades\Validator;

class CargoController extends Controller
{
    public function index(Request $request){

        $data = [];

        if($request->isMethod("POST")){
             

            $validator = Validator::make($request->all(), [
                'nomecargo' => 'required|unique:cargos|max:30'
            ], [
                'nomecargo.required' => 'O campo nome do cargo  é obrigatório',
                'nomecargo.unique' => 'O cargo em inserido já foi cadastrado anteriormente no sistema',
                'nomecargo.max' => 'O nome do cargo pode possuir no máximo 30 caracteres',
            ]);
            if($validator->fails()){
                //var_dump(); die();
               // dd("Preencha todos os campos");
              // return redirect()
              // ->route("cargo")
             //  ->withErrors($validator);
               return back()->withErrors($validator)->withInput();


            }
            //$nomecargo = $request->input("nomecargo");
            //$cargo = new Cargo();
            //$cargo->nomecargo = $nomecargo;

            //Adicionei os valores do formulário  no objeto cargo
            $cargo = new Cargo($request->all());

            //Salvar o objeto cargo
            $cargo->save();

        };
        
        //select * from cargos
        $data["lista"] = Cargo::all();

        return view("cargo/index", $data);

    }
    
}
