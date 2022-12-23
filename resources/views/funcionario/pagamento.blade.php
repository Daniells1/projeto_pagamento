@extends("layout")
@section("conteudo")
    <h1>Realizar Pagamento</h1>
    <form action="" id="myForm">
        <div class="form-group">
            <label for="cpf">Cpf</label>
            <input type="text" name="cpf" id="cpf" class="form-control">
        </div>
        
        <div id="resultado"></div>
        <div id="mensagem-pagamento"></div>
    </form>
    <script>
        document.querySelector("#cpf").addEventListener('blur', (event) =>{
            let cpf = event.target.value
            document.getElementById("resultado").innerHTML = "";
            document.getElementById("mensagem-pagamento").style.display = "none";
            


            fetch("{{ route('funcionario_pagamento_1') }}?cpf=" + cpf)
            .then((result)=> result.text())
            .then((result) => {
                document.getElementById("resultado").innerHTML = result
                jsAjaxReturn();
            })
            
            .catch(error => console.log(error))
        })
        
        const jsAjaxReturn = () => {
        document.querySelector("#salvar-pagamento").addEventListener('click', (event) => {
            let dadosFormulario = document.querySelector("#myForm")
            let formData = new FormData(dadosFormulario)
          fetch("{{ route('funcionario_pagamento_2')}}", {
            method: 'POST',
            body: formData,
            headers: {
                "X-CSRF-Token": "{{ csrf_token() }}"
            }
          })
          .then(result => result.json())
          .then(result => {
            
            document.getElementById("mensagem-pagamento").style.display = "block";

            if(result.status == "error"){
                document.getElementById("mensagem-pagamento").classList.remove("alert-success")
                document.getElementById("mensagem-pagamento").classList.add("alert", "alert-danger")
                document.getElementById("mensagem-pagamento").innerHTML = result.msg
                return;
                
            }

            document.getElementById("mensagem-pagamento").classList.remove("alert-danger")
                document.getElementById("mensagem-pagamento").classList.add("alert", "alert-success")
                document.getElementById("mensagem-pagamento").innerHTML = result.msg
                
                document.getElementById("cpf").value = "";
                document.getElementById("resultado").innerHTML = "";

                
          })
          .catch(error => console.log(error))
         })
         }
    </script>
@endsection