@extends("layout")
@section("conteudo")
    <h1>Novo Cargo</h1>
    
    <form method="post">
        <div class="form-group" action="{{ route('cargo') }}">
            @csrf
            <label for="nome" class="form-label">Nome do Cargo </label>
            <input type="text" name="nomecargo" id="nomecargo" class="form-control" value="{{ old('nomecargo') }}">
        </div>
     <input type="submit" value="Salvar" class="btn btn-primary mt-3">
    </form>
    @if(isset($lista) && count($lista) > 0)
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOME DO CARGO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lista as $c)
                 <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->nomecargo }}</td>
                 </tr>
            @endforeach
        </tbody>
    </table>
    @endif
@endsection