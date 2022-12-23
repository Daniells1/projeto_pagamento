<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal("valor", 10,2);
            $table->date("dt_pagamento");
            $table->decimal("hora_extra", 10,2);
            $table->text("descricao")->nullable();
            $table->string("tipo", 10);

            $table->integer("funcionario_id")->unsigned();

            $table->foreign("funcionario_id")
                ->references("id")
                ->on("funcionarios");
            
            $table->timestamps();
            


            


         //   "valor", "dt_pagamento", "hora_extra", "descricao", "tipo", "funcionario_id"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamentos');
    }
}
