@extends('master.master')

@section('content')
<div id="root">
    <div id="page-landing">
        <div class="content-wrapper">
            <img src="<?= asset('/images/logo.svg')?>" alt="Logo sistema">
            <main>
                <h1>Descubra mais sobre os nativos brasileiros</h1>
                <p>Aprenda sobre quem são, onde vivem e muito mais sobre sua cultura e história.</p>
            </main>
            <div class="location">
                <strong>Goiás</strong>
            </div>
            <a class="enter-app" href="{{ route('terra-listar') }}">
                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="rgba(0, 0, 0, 0.6)" height="26" width="26" xmlns="http://www.w3.org/2000/svg" style="color: rgba(0, 0, 0, 0.6);">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection