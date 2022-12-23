<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Projeto extends Model
{
    use HasFactory;

    protected $table = "projetos";
    protected $fillable = ["nome"];
    //cria os campos created_at e updated_at
    public $timestamps = false;

    public function funcionarios() : BelongsToMany {
        return $this->belongsToMany(Funcionario::class, "projeto_funcionarios", "projeto_id", "funcionario_id");
      
    }

   
}
