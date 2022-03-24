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
        
        <div class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0" style="width: 100%; height: 100%; position: relative;">
            <div class="leaflet-pane leaflet-map-pane" style="transform: translate3d(0px, 0px, 0px);">
                <div class="leaflet-pane leaflet-tile-pane">
                    <div class="leaflet-layer " style="z-index: 1; opacity: 1;">
                        <div class="leaflet-tile-container leaflet-zoom-animated" style="z-index: 18; transform: translate3d(0px, 0px, 0px) scale(1);">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/46/69.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(393px, 51px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/46/70.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(393px, 307px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/45/69.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(137px, 51px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/47/69.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(649px, 51px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/45/70.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(137px, 307px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/47/70.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(649px, 307px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/46/68.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(393px, -205px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/46/71.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(393px, 563px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/45/68.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(137px, -205px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/47/68.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(649px, -205px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/45/71.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(137px, 563px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/47/71.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(649px, 563px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/44/69.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(-119px, 51px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/48/69.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(905px, 51px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/44/70.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(-119px, 307px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/48/70.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(905px, 307px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/44/68.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(-119px, -205px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/48/68.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(905px, -205px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/44/71.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(-119px, 563px, 0px); opacity: 1;">
                            <img alt="" role="presentation" src="https://a.tile.openstreetmap.org/7/48/71.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(905px, 563px, 0px); opacity: 1;">
                        </div>
                    </div>
                </div>
                
                <div class="leaflet-pane leaflet-shadow-pane"></div>
                
                <div class="leaflet-pane leaflet-overlay-pane"></div>
                
                <div class="leaflet-pane leaflet-marker-pane">
                    <img src="/static/media/map-marker.61520125.svg" class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0" style="margin-left: -29px; margin-top: -68px; width: 58px; height: 68px; transform: translate3d(610px, 43px, 0px); z-index: 43;">
                    <img src="/static/media/map-marker.61520125.svg" class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0" style="margin-left: -29px; margin-top: -68px; width: 58px; height: 68px; transform: translate3d(5001px, -1229px, 0px); z-index: -1229;">
                    <img src="/static/media/map-marker.61520125.svg" class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0" style="margin-left: -29px; margin-top: -68px; width: 58px; height: 68px; transform: translate3d(5001px, -1229px, 0px); z-index: -1229;">
                    <img src="/static/media/map-marker.61520125.svg" class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0" style="margin-left: -29px; margin-top: -68px; width: 58px; height: 68px; transform: translate3d(5001px, -1229px, 0px); z-index: -1229;">
                    <img src="/static/media/map-marker.61520125.svg" class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0" style="margin-left: -29px; margin-top: -68px; width: 58px; height: 68px; transform: translate3d(5001px, -1229px, 0px); z-index: -1229;">
                    <img src="/static/media/map-marker.61520125.svg" class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0" style="margin-left: -29px; margin-top: -68px; width: 58px; height: 68px; transform: translate3d(5001px, -1229px, 0px); z-index: -1229;">
                    <img src="/static/media/map-marker.61520125.svg" class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0" style="margin-left: -29px; margin-top: -68px; width: 58px; height: 68px; transform: translate3d(446px, 163px, 0px); z-index: 163;">
                    <img src="/static/media/map-marker.61520125.svg" class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0" style="margin-left: -29px; margin-top: -68px; width: 58px; height: 68px; transform: translate3d(448px, 157px, 0px); z-index: 157;">
                    <img src="/static/media/map-marker.61520125.svg" class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0" style="margin-left: -29px; margin-top: -68px; width: 58px; height: 68px; transform: translate3d(351px, 144px, 0px); z-index: 144;">
                    <img src="/static/media/map-marker.61520125.svg" class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0" style="margin-left: -29px; margin-top: -68px; width: 58px; height: 68px; transform: translate3d(352px, 141px, 0px); z-index: 141;">
                    <img src="/static/media/map-marker.61520125.svg" class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0" style="margin-left: -29px; margin-top: -68px; width: 58px; height: 68px; transform: translate3d(495px, 310px, 0px); z-index: 310;">
                </div>
                
                <div class="leaflet-pane leaflet-tooltip-pane"></div>
                <div class="leaflet-pane leaflet-popup-pane"></div>
                <div class="leaflet-proxy leaflet-zoom-animated" style="transform: translate3d(11883.5px, 17925.6px, 0px) scale(64);"></div>
            </div>
            <div class="leaflet-control-container">
                <div class="leaflet-top leaflet-left">
                    <div class="leaflet-control-zoom leaflet-bar leaflet-control">
                        <a class="leaflet-control-zoom-in" href="#" title="Zoom in" role="button" aria-label="Zoom in">+</a>
                        <a class="leaflet-control-zoom-out" href="#" title="Zoom out" role="button" aria-label="Zoom out">−</a>
                    </div>
                </div>

                <div class="leaflet-top leaflet-right"></div>
                <div class="leaflet-bottom leaflet-left"></div>

                <div class="leaflet-bottom leaflet-right">
                    <div class="leaflet-control-attribution leaflet-control">
                        <a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a>
                    </div>
                </div>
            </div>
        </div>
        
        <a class="criar-aldeia" href="{{ route('terra-criar') }}">
            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="#FFF" height="32" width="32" xmlns="http://www.w3.org/2000/svg" style="color: rgb(255, 255, 255);">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </a>
    </div>
</div>
@endsection