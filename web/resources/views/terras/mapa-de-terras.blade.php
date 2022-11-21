@extends('layouts.main')
@section('title', 'Todas as terras - Abaeté')
@section('content')
<div id="root">
    <div id="page-map">
        <aside>
            <header>
                <img src="{{ asset('images/map-marker.svg') }}" alt="Abaeté">
                <h2>Cadastre uma terra indígena</h2>
                <p>Após o cadastrado, as terras irão aparecer no mapa ao lado.</p>
            </header>
            <footer>
                <a href="{{ route('logout') }}" title="Logout">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="rgba(0, 0, 0, 0.6)" height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="color: rgba(0, 0, 0, 0.6);">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
            </footer>
        </aside>

        <div id="map-container" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0" style="width: 100%; height: 100%; position: relative;">

        </div>

        <a class="criar-terra" href="{{ route('redireciona.criar.terra') }}" title="Criar terra">
            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="#FFF" height="32" width="32" xmlns="http://www.w3.org/2000/svg" style="color: rgb(255, 255, 255);">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </a>
        <a class="criar-quiz" href="{{ route('quizzes') }}" title="Gerenciar quiz">
            <svg fill="none" stroke-width="2" viewBox="0 0 24 24" height="32" width="32" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 4C9.243 4 7 6.243 7 9h2c0-1.654 1.346-3 3-3s3 1.346 3 3c0 1.069-.454 1.465-1.481 2.255-.382.294-.813.626-1.226 1.038C10.981 13.604 10.995 14.897 11 15v2h2v-2.009c0-.024.023-.601.707-1.284.32-.32.682-.598 1.031-.867C15.798 12.024 17 11.1 17 9c0-2.757-2.243-5-5-5zm-1 14h2v2h-2z" fill="#ffffff" class="fill-000000"/>
            </svg>
        </a>
        <a class="criar-admin" href="{{ route('administradores') }}" title="Gerenciar administradores">
            <svg  viewBox="0 0 32 32" height="32" width="32" xmlns="http://www.w3.org/2000/svg">
                <g data-name="78-user">
                    <circle cx="16" cy="8" r="7" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px" class="stroke-000000"/>
                    <path d="M28 31a12 12 0 0 0-24 0Z" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px" class="stroke-000000"/>
                </g>
            </svg>
        </a>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/mapIcon.js') }}"></script>
<script src="{{ asset('js/carregar-mapa.js') }}"></script>
<script src="{{ asset('js/carregar-terras-no-mapa.js') }}"></script>
@endpush
@endsection
