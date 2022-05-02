@extends('master.master')
@section('title', 'Login - Abaeté')
@section('content')
<div id="container-login">
    <div class="margem-abaixo">
        <img src="<?= asset('images/map-marker.svg') ?>" alt="Abaeté">
    </div>
    <h1>Área Restrita</h1>
    <form name="formLoginAdministrador">
        @csrf
        <fieldset>
            <div class="margem-abaixo">
                <input type="text" name="login" id="login" placeholder="Insira seu login" required="">
            </div>
            <div class="margem-abaixo" id="container-senha">
                <label for="senha" id="entrada-senha">
                    <input type="password" name="senha" id="senha" placeholder="Senha" required="">
                    <ion-icon name="eye" id="btn-senha" onclick="mostrarOcultarSenha()" onmouseenter="mudarTitulo()" role="img" class="md hydrated" aria-label="eye">
                    </ion-icon>
                </label>
            </div>

            <div id="message"class="d-none margem-abaixo"></div>

            <div class="margem-abaixo">
                <a href="#" >Esqueceu a senha?</a>
            </div>
            <div class="margem-abaixo">
                <button>Login</button>
            </div>
        </fieldset>
    </form>
</div>

<script>
    function mostrarOcultarSenha() {
        var senha = document.getElementById("senha");
        var btn = document.getElementById("btn-senha");

        if (senha.type == "password") {
            senha.type = "text";
            btn.name = 'eye-off';
        } else {
            senha.type = "password";
            btn.name = 'eye';
        }
    }
</script>
<script>
 $(function() {
     $('form[name="formLoginAdministrador"]').submit(function(event) {
         event.preventDefault();

         $.ajax({
             url: "{{ route('fazer-login') }}",
             type: "POST",
             data: $(this).serialize(),
             dataType: 'json',
             success: function( response ) {
                 $('#login').val("");
                 $('#senha').val("");
                 window.location.href = "{{ route('terras' ) }}";
             }
        })
        .fail(function(jqXHR){
            $('#message').removeClass('d-none').html(jqXHR.responseJSON.message);
        });
     })
 });
</script>
@endsection