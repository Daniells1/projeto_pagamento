<nav class="mb-3">
    <div class="nav nav-tabs">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-historico">Histórico de Pagamentos</button>
        <button class="nav-link " data-bs-toggle="tab" data-bs-target="#nav-funcionario">Dados do Funcionário</button>

    </div>
</nav>
<div class="tab-content" id="nav-tabcontent">
<div class="tab-pane fade show active" id="nav-historico">

<h1>Histórico de Pagamento</h1>
@if(isset($listaPagamento) && ($listaPagamento) > 0)
<table class="table table-bordered">
    <thead>
        <tr>
            <td>Tipo</td>
            <td>Valor</td>
            <td>Data do Pagamento</td>
            <td>Hora Extra</td>
            <td>Descrição</td>
        </tr>
    </thead>
    <tbody>
     @foreach($listaPagamento as $pagamento)
     <tr>
        <td>{{ $pagamento->tipo }}</td>
        <td>{{ Helper::fn($pagamento->valor) }}</td>
        <td>{{ Helper::formatDate($pagamento->dt_pagamento) }}</td>
        <td>{{ Helper::fn($pagamento->hora_extra) }}</td>
        <td>{{ $pagamento->descricao }}</td>

     </tr>
     @endforeach
    </tbody>
</table>
@else
   <div class="alert alert-warning">
    Nenhum Pagamento Registrado para o Funcionário
   </div>
@endif
</div>
<div class="tab-pane fade " id="nav-funcionario ">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Dados do Funcionário
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                     <label for="" class="my-label">Nome</label>
                    {{ $func->nome }}
                </div>
                <div class="col-4">
                <label for="" class="my-label">Cpf</label>
                    {{ $func->cpf }}
                </div>
                <div class="col-4">
                <label for="" class="my-label">Salário</label>
                    {{ Helper::fn($func->salario) }}
                </div>
                <div class="col-4">
                <label for="" class="my-label">Nome</label>
                    {{ $func->nome }}
                </div>
                <div class="col-4">
                <label for="" class="my-label">Data de Admissão</label>
                    {{ $func->getDtAdmissaoView() }}
                </div>
                <div class="col-4">
                <label for="" class="my-label">Cargo</label>
                    {{ $func->cargo->nomecargo }}
                </div>
                <div class="col-4">
                <label for="" class="my-label">Data de Demissão</label>
                    {{ $func->getDtDemissaoView() }}
                </div>
            </div>
        </div>
    </div>
    
</div>

</div>