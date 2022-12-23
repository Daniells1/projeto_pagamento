<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Projeto;
use App\Models\Funcionario;
use App\Models\Pagamento;

class FuncionarioController extends Controller
{
    public function novo($id = 0){
        $data = [];
        $f = new Funcionario();

        if($id != 0){
            //que a rota chamada foi a rota do Editar]
            $f = Funcionario::find($id);
        }

        $data["func"] =  $f;

        $data["listaProjeto"] = Projeto::all() ;

        $data["listaCargo"] = Cargo::all() ;
        return view("funcionario/novo", $data);

    }
    public function buscar(Request $request){

        $data = [];
        
        if($request->isMethod("post")){
         //resgatar os dados do formulário

         $nome = $request->input("nome");
         $cpf = $request->input("cpf");
         $cargo = $request->input("cargo");
         $status = $request->input("status");

         $queryFuncionario = Funcionario::join("cargos", "funcionarios.cargo_id", "=" ,"cargos.id");
         if($nome != ""){
            $queryFuncionario = $queryFuncionario->where("nome", "like", $nome . "%" );
         }

         if($cpf != ""){
            $queryFuncionario = $queryFuncionario->where("cpf", "=", $cpf );

        }

        if($cargo != ""){
            $queryFuncionario = $queryFuncionario->where("cargo_id", $cargo);

        }

            $queryFuncionario = $queryFuncionario->where("status", $status);
            $queryFuncionario = $queryFuncionario->orderBy("funcionarios.nome")
                                                ->limit(100);
            
            \Log::info("Query de Funcionários", [$queryFuncionario->toSql() ]);
            $data["listaFuncionario"] = $queryFuncionario->get(['nome', 'nomecargo', 'salario', 'dt_admissao', 'cpf', 
                                                              'funcionarios.id as idfuncionario', 'status']);

        
    }

        $data["listaCargo"] = Cargo::orderBy("nomecargo")->get();
        return view("funcionario/buscar", $data);

     }
    public function novoConfirma(Request $request){
        try{

        $id = $request->input("id", "");
        
        //dd($request->input("projetos"));
       // $f = new Funcionario($request->all());
       $f = new Funcionario();

        if($id != "" && is_numeric($id)){
            $f = Funcionario::find($id);

        }

        $f->fill($request->all());


        $f->status = "A";
        //$f->cargo_id = $request->input("cargo");
        $cargo = Cargo::find($request->input("cargo"));
        $f->cargo()->associate($cargo);
        if(!$f->save()){
            return back()->withErrors($f->getErrors());
        };

        $projetos = $request->input("projetos", []);

       // $f->projetos()->attach($projetos);
         
       $f->projetos()->sync($projetos);
        $request->session()->flash("success", "Funcionario salvo com sucesso!");
        }catch(\Exception $e){
            \Log::error("Erro ao salvar funcionário", [ $e->getMessage() ]);
            $request->session()->flash("error", "Funcionario  não salvo!");

        }

        return back();
    }
    public function pagamento(){
        return view("funcionario/pagamento");
    }

    public function excluir($id, Request $request){
        try{
        $func = Funcionario::find($id);
        if($func == null){
            $request->session()->flash("error", "Funcionario  não cadastrado!");
            return back();
        }

        if($func->status == "I"){
            $request->session()->flash("error", "Funcionario  já está inativado!");
            return back();

        }
     
     //Aqui pegar a data e converter para o padrão dia/mês/ano

        $func->status = "I";
        $func->dt_demissao = \Carbon\Carbon::now()->format("d/m/Y");
        $func->save( ['ignoreValidate' => true] );

        $request->session()->flash("success", "Funcionario  inativado com sucesso!");
    }catch(\Exception $e){
        \Log::error("Erro ao excluir funcionario", [ $e->getMessage()]);
    }
        return back();
    }
    
    public function pagamentoConsultarFuncionario(Request $request){
        $cpf = $request->input("cpf", "");
        $func = Funcionario::where("cpf", $cpf)->first();
        $data["f"] = $func;
        return view("funcionario/pagamento-funcionario", $data);

}
   public function pagamentoFuncionarioSave(Request $request){
    $cpf = $request->input("cpf");
    $func = Funcionario::where("cpf", $cpf)->first();
    if($func == null){
       return response()->json([
        'status' => 'error',
        'msg' => 'Cpf não encontrado'
       ]);
    }
    try{
        $pagamento = new Pagamento($request->all());
        $pagamento->funcionario()->associate($func);
        if(!$pagamento->save()){
        
            return response()->json([
                'status' => 'error' ,
                'msg' => implode("<br>", $pagamento->getErrors()->all()),
               ]);

        }

        return response()->json([
            'status' => 'ok',
            'msg' => 'Pagamento Realizado com Sucesso',
           ]);



    }catch(\Exception $e){
        \Log::error("ERRO PAGAMENTO", [ $e->getMessage() ]);
        return response()->json([
            'status' => 'error',
            'msg' => 'Erro ao salvar pagamento',
           ]);
    }
   
   }
   
   public function historicoPagamento(Request $request){

    $idFuncionario = $request->input("id");

    $func =  Funcionario::find($idFuncionario);


    $dias90 = \Carbon\Carbon::now();
    $dias90 = $dias90->subDays(90);

    $queryPagamento = Pagamento::where("funcionario_id", $idFuncionario)
       ->where("dt_pagamento", ">=", $dias90->format("Y-m-d"))
       ->orderBy("dt_pagamento", "desc");

       $data = [ 'listaPagamento'=>$queryPagamento->get() , 'func' => $func ];
       return view("funcionario/historico-pagamento", $data);


   }
}
