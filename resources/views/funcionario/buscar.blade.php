@extends("layout")
@section("conteudo")

<style>
    .btn > i {
      pointer-events: none;
    }
</style>
    <h1>Buscar Funcionário</h1>
    <form action="{{ route('funcionario_buscar') }}" method="post">
        @csrf
        <div class="row">

        
                <div class="form-group col-4">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control">
                </div>
                <div class="form-group col-3">
                    <label for="cpf" class="form-label">Cpf</label>
                    <input type="text" name="cpf" id="cpf" class="form-control">
                </div>
            
                <div class="form-group col-3">
                    <label for="cargo" class="form-label">Cargo</label>
                    <select name="cargo" id="cargo" class="form-control">
                        <option value=""></option>
                        @if(isset($listaCargo) && count($listaCargo) > 0)
                          @foreach($listaCargo as $c)
                          <option value="{{ $c->id }}">{{ $c->nomecargo }}</option>

                          @endforeach
                        @endif
                    </select>
                </div>
                
                <div class="form-group col-2">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="A">Ativo</option>
                        <option value="I">Inativo</option>
                    </select>
                </div>

        </div>
        <input type="submit" value="Buscar" class="btn btn-info mt-3 mb-2 text-white">
    </form>
    @if(isset($listaFuncionario) && count($listaFuncionario) > 0 )
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NOME</th>
                <th>CPF</th>
                <th>SALÁRIO</th>
                <th>CARGO</th>
                <th>ADMISSÃO</th>
                <th>AÇÃO</th>
                </tr>

            
        </thead>
        <tbody>
            @foreach($listaFuncionario as $func)
            <tr>
                <td>{{ $func->nome }}</td>
                <td>{{ $func->cpf }}</td>
                <td>{{ Helper::fn($func->salario) }}</td>
                <td>{{ $func->nomecargo }}</td>
                <td>{{ $func->getDtAdmissaoView() }}</td>
                <td>
                    @if($func->status == "A" )
                    <a href="{{ route('funcionario_excluir', ['id'=> $func->idfuncionario ])}}" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                    <a href="{{ route('funcionario_editar', ['id'=> $func->idfuncionario ] )}}" class="btn btn-sm btn-warning text-white"><i class="fa-solid fa-pen-to-square"></i></a>
                    @endif

                    <a href="#" class="btn btn-sm btn-secondary btn-historico-pagamento" data-bs-toggle="modal"
                     data-bs-target="modal-detalhes" data-value="{{ $func->idfuncionario }}"><i class="fa-regular fa-file-lines"></i></a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <script>
        const historicoPagamento = (event) => {
           // console.log(event.target)
          let idFuncionario = event.target.getAttribute("data-value")
          
          fetch("{{ route('funcionario_historico_pagamento') }}", {
            method: 'POST',
            headers : {
                'X-CSRF-Token' : "{{ csrf_token() }}",
                'Content-Type' : 'application/json'
            },
            body : JSON.stringify({ id : idFuncionario }) 
          })
          .then( result => result.text() )
          .then( result => document.getElementById("modal-conteudo").innerHTML = result)
          .catch(( error =>{
            console.log(error)
            alert("Histórico de Pagamentos não pode ser carregado")
          }))
        }
        document.querySelectorAll(".btn-historico-pagamento").forEach(item=> {
            item.addEventListener('click', event => historicoPagamento(event))
        })
    </script>
@endsection