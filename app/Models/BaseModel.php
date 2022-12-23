<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
//classe abstrata não instanciada,sempre é herdada
{
    use HasFactory;


    protected $fillable = [];

   protected $rules = [
    

   ];
   protected $messages = [
  
   ];
   protected $errors;

   public function validate():bool{

    

    $validator = \Validator::make($this->attributes, $this->rules, $this->messages);
    

    if($validator->fails()){
        $this->errors = $validator->errors();
        return false;
    }
    return true;
   }

   public function getErrors()
{
    return $this->errors;
}

   public abstract function beforeSave();

   public function save(array $options = []){
    try{
        if(( !isset($options["ignoreValidate"])  || !$options["ignoreValidate"] ) && !$this->validate()){
           return false;
        }

        $this->beforeSave();
       

        return parent::save($options);

    }catch(\Exception $e){
        \Log::error("ERRO NO SAVE", [ $e->getMessage()]);
        return false;
    }

}

public function convertDateToDB($date){
    try{
        $patternDateFormat = "/^\d{4}\-\d{2}\-\d{2}$/";
        if($date != null && !\preg_match($patternDateFormat, $date)){
            $dt = \Carbon\Carbon::createFromFormat("d/m/Y", $date);
            return $dt->format("Y-m-d");
        }

        return $date;

    }catch(\Exception $e){
        \Log::error("ERRO NA FORMATAÇÃO DA DATA", [ $e->getMessage() ]);
        return null;
    }

}

}