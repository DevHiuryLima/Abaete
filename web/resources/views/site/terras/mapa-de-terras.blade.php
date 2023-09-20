@extends('layouts.main')
@section('title', 'Todas as terras - Abaeté')
@section('content')
    <div id="root">
        <div id="page-map">
            <aside>
                <header>
                    <img src="{{ asset('images/map-marker.svg') }}" alt="Abaeté">
                    <h2>Localize uma terra indígena</h2>
                    <p>
                        Clique em um marcador para ver o nome da terra indígena e clique na seta para mais informações.
                    </p>
                </header>
                <footer>
                    <a href="{{ route('home') }}" title="Voltar">
                        <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="rgba(0, 0, 0, 0.6)" height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="color: rgba(0, 0, 0, 0.6);">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </a>
                </footer>
            </aside>

            <div id="map-container" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0" style="width: 100%; height: 100%; position: relative;">

            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/mapIcon.js') }}"></script>
        <script src="{{ asset('js/carregar-mapa.js') }}"></script>
        <script src="{{ asset('js/site/carregar-terras-no-mapa.js') }}"></script>
    @endpush
@endsection
