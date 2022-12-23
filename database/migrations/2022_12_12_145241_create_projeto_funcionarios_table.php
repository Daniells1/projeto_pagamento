<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetoFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projeto_funcionarios', function (Blueprint $table) {
            $table->integer("projeto_id")->unsigned();
            $table->integer("funcionario_id")->unsigned();
           
            $table->foreign("projeto_id")
                ->references("id")
                ->on("projetos");
            
            $table->foreign("funcionario_id")
                ->references("id")
                ->on("funcionarios");    
           
        $table->primary([ "projeto_id", "funcionario_id"])    ;    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projeto_funcionarios');
    }
}
