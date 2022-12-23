<div class="mt-2">


@if(isset($f) && $f != null)

<div class="row">
    <div class="col-6">
      <label >Nome:</label>
      {{ $f->nome }}
    </div>

    <div class="col-6">
      <label >Salário:</label>
      {{ $f->salario }}
    </div>

    <div class="col-6">
      <label >Admissão:</label>
      {{ $f->getDtAdmissaoView() }}
    </div>

    <div class="col-6">
      <label >Situação:</label>
      {{ $f->getStatus() }}
    </div>

    <div class="col-6">
      <label > Cargo:</label>
      {{ $f->cargo->nomecargo }}
    </div>

    <div class="col-6">
      <label > Data de Demissão:</label>
      {{ $f->dt_demissao }}
    </div>

    

  
</div>

<div class="row">
  <div class="col-6 form-group">
    <label for="valor" class="form-label">Valor do Pagamento: </label>
    <input type="text" name="valor" id="valor" value="{{ $f->salario }}" class="form-control">

  </div>

  <div class="col-6 form-group">
    <label for="dt_pagamento" class="form-label">Data do Pagamento: </label>
    <input type="text" name="dt_pagamento" id="dt_pagamento" value="{{\Carbon\Carbon::now()->format('d/m/Y') }}" class="form-control">

  </div>

  <div class="col-6 form-group">
    <label for="hora_extra" class="form-label">Valor de Hora Extra: </label>
    <input type="text" name="hora_extra" id="hora_extra" value="" class="form-control">

  </div>

  <div class="col-6 form-group">
    <label for="tipo" class="form-label">Tipo de Pagamento: </label>
    <select name="tipo" id="tipo" class="form-control">
      <option value="SALARIO">SALÁRIO</option>
      <option value="DEMISSAO">DEMISSÃO</option>
      <option value="OUTRO">OUTRO</option>

    </select>

  </div>
  <div class="col-12 form-group">
    <label for="descricao" class="form-label">Descrição do Pagamento: </label>
    <textarea name="descricao" id="descricao" class="form-control" ></textarea>

  </div>

</div>

</div>
<input type="button" value="Salvar Pagamento" id="salvar-pagamento" class="btn btn-primary mt-2">

@else
   <div class="alert alert-warning">
    Funcionário não encontrado
   </div>
@endif

</div>