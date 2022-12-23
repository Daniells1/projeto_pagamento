<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    
    protected $table = "cargos";
    protected $fillable = ["nomecargo"];
    //cria os campos created_at e updated_at
    public $timestamps = false;
}
