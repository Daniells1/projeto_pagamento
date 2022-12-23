<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->increments("id");
       
            $table->string("nome", 100);
            $table->string("cpf", 20)->unique();
            $table->decimal("salario", 10,2);
            $table->date("dt_admissao");
            $table->date("dt_demissao")->nullable();
            $table->string("status", 1);

            $table->integer("cargo_id")->unsigned();

            $table->foreign("cargo_id")
                ->references("id")
                ->on("cargos");


            $table->timestamps();



           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
}
