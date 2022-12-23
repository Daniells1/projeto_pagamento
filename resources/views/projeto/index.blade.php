@extends("layout")
@section("conteudo")
<h1>Novo Projeto</h1>
<form method="post">
    <div action="{{ route('projeto') }}" class="form-group">
        @csrf
        <label for="nomeprojeto" class="form-label">Nome do Projeto</label>
        <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}">
    </div>
    <input type="submit" value="Salvar" class="btn btn-primary mt-3">
</form>

@if(isset($lista) && count($lista) > 0)
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOME DO PROJETO</th>
            <th>NÚMERO DE FUNCIONÁRIOS</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lista as $proj)
        <tr>
            <td> {{ $proj->id }}      </td>
            <td> {{ $proj->nome }}    </td>
            <td> {{ $proj->funcionarios()->count() }}</td>
        </tr>

        @endforeach
    </tbody>
</table>
 @endif
@endsection