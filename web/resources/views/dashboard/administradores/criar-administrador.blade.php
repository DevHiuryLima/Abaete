@extends('layouts.main')
@section('title', 'Criar administrador - Abaeté')
@section('content')
<div id="root">
    <div id="page-form">
        <aside class="app-sidebar">
            <img src="{{ asset('images/map-marker.svg') }}" alt="Abaeté">

            <footer>
                <a onclick="history.back()" title="Voltar">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="rgba(0, 0, 0, 0.6)" height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="color: rgba(0, 0, 0, 0.6);">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
            </footer>
        </aside>

        <main>
            <form class="form-create-and-update" action="{{ route('criar.administrador') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <fieldset>
                    <legend>Dados</legend>
                    <fieldset>
                        <div class="input-block field">
                            <label for="name">Nome</label>
                            <input type="text" name="name" id="name" required="">
                        </div>
                        <div class="input-block field-group">
                            <div class="field">
                                <label for="email">E-mail</label>
                                <input type="email" name="email" id="email" required="">
                            </div>
                        </div>
                        <div class="input-block field-group">
                            <div class="field">
                                <label for="password">Senha</label>
                                <input type="password" name="password" id="password" minlength="6" required="">
                                <small style="color: #8FA7B3;">A senha devem ter pelo menos seis caracteres.</small>
                            </div>
                        </div>
                    </fieldset>
                </fieldset>
                <button class="confirm-button" type="submit">Confirmar</button>
            </form>
        </main>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/criar-terra.js') }}"></script>
@endpush
@endsection
