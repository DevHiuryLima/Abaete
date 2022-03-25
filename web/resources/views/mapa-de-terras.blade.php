@extends('master.master')

@section('content')
<div id="root">
    <div id="page-map">
        <aside>
            <header>
                <img src="<?= asset('images/map-marker.svg') ?>" alt="Abaeté">
                <h2>Cadastre uma terra indígena</h2>
                <p>Após o cadastrado, as terras irão aparecer no mapa ao lado.</p>
            </header>
            <footer>
                <a href="{{ route('home') }}">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="rgba(0, 0, 0, 0.6)" height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="color: rgba(0, 0, 0, 0.6);">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
            </footer>
        </aside>
        
        <div id="map-container" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0" style="width: 100%; height: 100%; position: relative;">

        </div>
        
        <a class="criar-aldeia" href="{{ route('terra-criar') }}">
            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="#FFF" height="32" width="32" xmlns="http://www.w3.org/2000/svg" style="color: rgb(255, 255, 255);">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </a>
    </div>
</div>

<script>

    // A variavel 'map' recebe a classe leaflet (l) ponto map
    // passando a div do mapa para tudo que for criado ser dentro dela
    // coloando a posição e também o nivel de zoom
    var map = L.map(document.getElementById('map-container'), {
        center: [-16.6954999,-49.444356], 
        zoom: 7
    });


    // Crio a variavel que vai ser a base do meu mapa e estou criando uma layer a partir do open street map
    var baseMap = L.tileLayer('https://a.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    });
    baseMap.addTo(map);
</script>
@endsection