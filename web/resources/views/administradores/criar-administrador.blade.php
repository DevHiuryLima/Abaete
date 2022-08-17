@extends('layouts.main')
@section('title', 'Criar administrador - Abaeté')
@section('content')
<div id="root">
    <div id="page-form">
        <aside class="app-sidebar">
            <img src="{{ asset('images/map-marker.svg') }}" alt="Abaeté">

            <footer>
                <a href="{{ route('administradores') }}" title="Voltar">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="rgba(0, 0, 0, 0.6)" height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="color: rgba(0, 0, 0, 0.6);">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
            </footer>
        </aside>

        <main>
            <form class="form-create-and-update" action="{{ route('criar') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <fieldset>
                    <legend>Dados</legend>
                    <fieldset>
                        <div class="input-block field">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" id="name" required="">
                        </div>
                        <div class="input-block field-group">
                            <div class="field">
                                <label for="login">Login</label>
                                <input type="text" name="login" id="login" required="">
                            </div>
                            <div class="field">
                                <label for="senha">Senha</label>
                                <input type="password" name="senha" id="senha" required="">
                            </div>
                        </div>
                    </fieldset>
                </fieldset>
                <button class="confirm-button" type="submit">Confirmar</button>
            </form>
        </main>
    </div>
</div>

<script>
    const APP_URL = `{{env('APP_URL')}}`;

    const API_URL = `{{env('APP_URL')}}` + `/api`;
</script>
<script src="<?=asset("js/criar-terra.js")?>"></script>
@endsection
