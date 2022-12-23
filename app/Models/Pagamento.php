<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pagamento extends BaseModel
{
    use HasFactory;
    protected $table = "pagamentos";
    protected $fillable = ["valor", "dt_pagamento", "hora_extra", "descricao", "tipo", "funcionario_id"];

    protected $rules = [
        'valor' => 'required',
        'dt_pagamento' => 'required|date_format:d/m/Y'
    ];

    protected $messages = [
        'valor.required' => 'Preencha o valor do pagamento',
        'dt_pagamento.required' => 'Data de Pagamento é obrigatório o valor do pagamento',
        'dt_pagamento.date_format' => 'Data do pagamento está inválida'

    ];

    public function funcionario() : BelongsTo{
        return $this->belongsTo(Funcionario::class, "funcionario_id");
    }

    public function beforeSave(){

        $this->dt_pagamento = $this->convertDateToDB($this->dt_pagamento);

        if(is_null($this->hora_extra)){
            $this->hora_extra = 0;
        }
    }
  
}
