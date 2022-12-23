<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  <!--  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"/>
   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
    <style>
        .my-label{
            font-weight: bold;
            display:block;
        }
    </style>
   

</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">HOME</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('cargo') }}" class="nav-link">CARGOS</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('projeto') }}" class="nav-link">PROJETOS</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('funcionario_novo') }}" class="nav-link">FUNCIONÁRIOS</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('funcionario_buscar') }}" class="nav-link">BUSCAR FUNCIONÁRIO</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('funcionario_pagamento') }}" class="nav-link">REALIZAR PAGAMENTO</a>
            </li>
            <!-- O ESPAÇAMENTO DEVE SER EXATAMENTE ESSE NOS ROUTES -->
        </ul>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12"> 
            
            @if(Session::has('success') && Session::get('success') != '')
            <div class="mt-2 alert alert-success">
               {{ Session::get('success') }}
            </div>
            @endif

            @if(Session::has('error') && Session::get('error') != '')
            <div class="mt-2 alert alert-warning">
               {{ Session::get('error') }}
            </div>
            @endif

            
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>

                @foreach($errors->all() as $erro)
                <li>{{ $erro }}</li>

                @endforeach
                </ul>
            </div>

            @endif

            <!--nesta parte do código quero que o conteudo seja inserido de forma dinamica -->
            @yield("conteudo")   
            
            <div class="modal fade" id="modal-detalhes">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Detalhes
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div id="modal-conteudo">

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">
                                  Fechar
                            </button>

                        </div>
                    </div>

                </div>

            </div>
            
            </div>
        </div>
    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
  </body>
</body>
</html>