<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Funcionario extends BaseModel
{
    use HasFactory;

    protected $table = "funcionarios";
    protected $fillable = ["nome", "cpf", "salario", "dt_admissao", "status", "cargo_id", "dt_demissao"];

   protected $rules = [
    'nome' => 'required|min:3',
    'cpf' => 'required',
    'salario' => 'required',
    'dt_admissao' => 'required|date_format:d/m/Y',
    //'dt_demissao' => 'date_format:d/m/Y',
    'cargo_id' => 'required',

   ];
   protected $messages = [
    'nome.required' => 'Preencha o campo nome',
    'nome.min' => 'Preencha o campo nome com no mínimo 3 caracteres',
    'cpf.required' => 'Preencha o campo CPF',
    'salario.required' => 'Preencha o campo Salário',
    'dt_admissao.required' => 'Preencha o campo Data de Admissão',
    'dt_admissao.date_format' => 'Preencha o campo Data de Admissão corretamente',
   // 'dt_demissao.date_format' => 'Preencha o campo Data de Demissão corretamente',
    'cargo_id.required' => 'Preencha o campo Cargo'
   ];
   protected $errors;
/*
   public function validate():bool{

    

    $validator = \Validator::make($this->attributes, $this->rules, $this->messages);
    

    if($validator->fails()){
        $this->errors = $validator->errors();
        return false;
    }
    return true;
   }
 /*  
   

    /**
     * Get the cargo that owns the Funcionario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cargo(): BelongsTo
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }


    public function projetos() : BelongsToMany {
        return $this->belongsToMany(Projeto::class, 'projeto_funcionarios', 'funcionario_id', 'projeto_id');
    }

    //cria os campos created_at e updated_at
    //   public $timestamps = false;
 //sobreescrevendo o método save da class model
 /*
    public function save(array $options = []){
        try{
            if(!$this->validate()){
                return false;
            }

            return parent::save($options);

        }catch(\Exception $e){
            \Log::error("SAVE FUNCIONÁRIO", [ $e->getMessage()]);
        }

    }
    public function getErrors()
    {
        return $this->errors;
    }
    */
    public function beforeSave(){
        $patternDateFormat = "/^\d{4}\-\d{2}\-\d{2}$/";
        try{
           
            /*
              dt_admissao = 'd/m/Y'
              dt_admissao = Y-m-d
            */


            if($this->dt_admissao != null && !\preg_match($patternDateFormat, $this->dt_admissao)){
                $dt = \Carbon\Carbon::createFromFormat("d/m/Y", $this->dt_admissao);
                $this->dt_admissao = $dt->format("Y-m-d");
            }

         


        }catch(\Exception $e){
            \Log::error("Erro Before Save", [ $e->getMessage()]);
        }

        try{
            if($this->dt_demissao != null){
                $dt = \Carbon\Carbon::createFromFormat("d/m/Y", $this->dt_demissao);
                $this->dt_demissao = $dt->format("Y-m-d");
            }


        }catch(\Exception $e){
            \Log::error("Erro Before Save", [ $e->getMessage()]);
        }


       
    }
    public function getDtAdmissaoView(){
        if($this->dt_admissao == null || $this->dt_admissao == "")
            return "";
            try{

                $dtFormat = \Carbon\Carbon::createFromFormat("Y-m-d", $this->dt_admissao);
                return $dtFormat->format("d/m/Y");

            }catch(\Exception $e){
                \Log::error("Format dt admissao to view", [ $e->getMessage() ]);
            }

       
    }
    public function getDtDemissaoView(){
        if($this->dt_demissao == null || $this->dt_demissao == "")
            return "";
            try{

                $dtFormat = \Carbon\Carbon::createFromFormat("Y-m-d", $this->dt_demissao);
                return $dtFormat->format("d/m/Y");

            }catch(\Exception $e){
                \Log::error("Format dt demissao to view", [ $e->getMessage() ]);
            }

       
    }
    public function getProjetosId(){
        $projetos = $this->projetos()->get(["id"]);
        $ids = [];

        $ids = array_map(function($item){
              return $item["id"];
        }, $projetos->toArray());

        return $ids;

    }

    public function getStatus(){
       if($this->status == "I")
           return "Demitido";

        return "Ativo";

    }
}
