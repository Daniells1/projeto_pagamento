@extends("layout")
@section("conteudo")
    <h1>Dados do Funcionário</h1>
    <form action="{{ route('funcionario_novo_confirma') }}" method="post">
        <input type="hidden" name="id" value="{{ $func->id }}">
        @csrf
        

        <div class="row">
        <div class="form-group col-6">
            <label for="nome" class="form-label ">Nome </label>
            <input type="text" class="form-control" name="nome" id="nome" value="{{ $func->nome }}">
        </div>

        <div class="form-group col-6">
            <label for="cpf" class="form-label ">Cpf </label>
            <input type="text" class="form-control" name="cpf" id="cpf" value="{{ $func->cpf }}">
        </div>

        <div class="form-group col-4">
            <label for="salario" class="form-label ">Salário </label>
            <input type="text" class="form-control" name="salario" id="salario" value="{{ $func->salario }}">
        </div>

        <div class="form-group col-4">
            <label for="dt_admissao" class="form-label ">Data de Admissão </label>
            <input type="text" class="form-control" name="dt_admissao" id="dt_admissao" value="{{ $func->getDtAdmissaoView() }}">
        </div>

    

        <div class="form-group col-4">
            <label for="nome" class="form-label">Cargo </label>
            <select name="cargo" id="cargo" class="form-control">
                <option value=""></option>
                @if(isset($listaCargo))
                    @foreach($listaCargo as $cargo)
                     <option value="{{ $cargo->id }}" @if($cargo->id ==  $func->cargo_id) selected @endif>{{ $cargo->nomecargo }}</option>
                    @endforeach
                @endif
            </select>
        </div>
       
         <div class="col-12">
            @if(isset($listaProjeto) && count($listaProjeto) > 0)
            @foreach($listaProjeto as $proj)
            <div class="form-check form-check-inline">
                <input type="checkbox" id="projeto{{ $proj->id }}" name="projetos[]" class="form-check-input" 
                @if(in_array($proj->id, $func->getProjetosId())) checked @endif
                value="{{ $proj->id }}">
                <label for="projeto{{ $proj->id }}" class="form-check-label">{{ $proj->nome }}</label>
            </div>
            @endforeach
            @endif
         </div>

        </div>
    
        <input type="submit" value="Salvar" class="btn btn-primary mt-3"> 


    </form>
@endsection