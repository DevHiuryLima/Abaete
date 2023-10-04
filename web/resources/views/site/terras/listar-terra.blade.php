@extends('layouts.main')
@section('title', $terra->nome  . ' - Abaeté')
@section('content')
<div id="root">
    <div id="page-list">
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
            <div class="detalhes">
                @if( count($terra->imagensTerra) > 0 )
                    <img src="{{env('APP_URL') . '/storage/' . $terra->imagensTerra[0]->url}}" alt="{{$terra->nome}}" title="{{$terra->referencia_das_fotos}}" >

                    <div class="images">
                        @php
                            $i = 0;
                        @endphp

                        @foreach($terra->imagensTerra as $imagem)
                            @if($i == 0)
                            <button class="active" type="button">
                                <img src="{{env('APP_URL') . '/storage/' . $imagem->url}}" alt="{{$terra->nome}}">
                            </button>
                            @else
                            <button class="" type="button">
                                <img src="{{env('APP_URL') . '/storage/' . $imagem->url}}" alt="{{$terra->nome}}">
                            </button>
                            @endif

                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </div>
                    <p class="texto-referencia">{{$terra->referencia_das_fotos}}</p>
                @endif
                <div class="detalhes-conteudo">
                    <div class="field-group">
                        <div class="field">
                            <h3>Nome</h3>
                            <hr class="row">
                            <p>{{$terra->nome}}</p>
                        </div>
                        <div class="field">
                            <h3>População</h3>
                            <hr>
                            <p>{{$terra->populacao}}</p>
                        </div>
                    </div>
                    <div class="field-group">
                        <div class="field">
                            <h3>Povos</h3>
                            <hr>
                            <p>{{$terra->povos}}</p>
                        </div>
                        <div class="field">
                            <h3>Língua</h3>
                            <hr>
                            <p>{{$terra->lingua}}</p>
                        </div>
                    </div>
                    <div class="field-group">
                        <div class="field">
                            <h3>Modalidade</h3>
                            <hr>
                            <p>{{$terra->modalidade}}</p>
                        </div>
                        <div class="field">
                            <h3>Estado</h3>
                            <hr>
                            <p>{{$terra->estado}}</p>
                        </div>
                    </div>
                    <div class="field-group">
                        <div class="field">
                            <h3>Cidade</h3>
                            <hr>
                            <p>
                                @foreach($terra->cidades as $cidade)
                                    - {{$cidade->cidade}}.<br>
                                @endforeach
                            </p>
                        </div>
                        <div class="field"></div>
                    </div>
                    <h3>Sobre</h3>
                    <hr>
                    <p class="justificar-texto" style="white-space: break-spaces; word-break: break-word;">{{$terra->sobre}}</p>
                    <div class="map-container">
                        <div id="map-container" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0" style="width: 100%; height: 280px; position: relative;">

                        </div>
                        <footer>
                            <a target="_blank" rel="noopener noreferrer" href="https://www.google.com/maps/dir/?api=1&amp;destination={{$terra->latitude}},{{$terra->longitude}}">Ver rotas no Google Maps</a>
                        </footer>
                    </div>

                </div>
            </div>
        </main>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/mapIcon.js') }}"></script>
<script>
    // A variavel 'map' recebe a classe leaflet (l) ponto map
    // passando a div do mapa para tudo que for criado ser dentro dela
    // coloando a posição e também o nivel de zoom
    var map = L.map(document.getElementById('map-container'), {
        center: [ {{$terra->latitude}} ,{{$terra->longitude}} ],
        zoom: 9
    });


    // Crio a variavel que vai ser a base do meu mapa e estou criando uma layer a partir do open street map
    var baseMap = L.tileLayer('https://a.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    });
    baseMap.addTo(map);

    L.marker([ {{$terra->latitude}} ,{{$terra->longitude}} ], {icon: abaeteMapIcon, interactive: false}).addTo(map);
</script>
<script>
    $('.images > button').on('click', function() {

        // Busca dentro da div.images o button que está com a classe 'active' e retira a classe.
        $('.images > button.active').attr('class', '');

        // Pega no button clicado os atributos do primeiro fiho
        let urlImagem = $(this).children().attr('src');
        let alt = $(this).children().attr('alt');


        // Troca a url e o atributo 'alt' na imagem maior
        $('.detalhes > img').attr('src', urlImagem);
        $('.detalhes > img').attr('alt', alt);

        // Declara a class 'active' para o button clicado.
        $(this).attr('class', 'active');
    });
</script>
@endpush
@endsection
