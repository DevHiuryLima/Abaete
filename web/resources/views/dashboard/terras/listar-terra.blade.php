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
                    <hr>
                    <button type="button" id="edit" class="action-button">
                        <a class="link" href="{{ route('redireciona.editar.terra', ['idTerra' => $terra->idTerra]) }}">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" color="#FFF" height="20" width="20" xmlns="http://www.w3.org/2000/svg" style="color: rgb(255, 255, 255);">
                                <path d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path>
                            </svg>Editar terra
                        </a>
                    </button>
                    <button type="button" id="delete" class="action-button">
                        <svg id="Icons" viewBox="0 0 24 24" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <style>.cls-1{fill:#FFFFFF;}</style>
                            </defs>
                            <path class="cls-1" d="M22,4H16V3a3,3,0,0,0-3-3H11A3,3,0,0,0,8,3V4H2A1,1,0,0,0,2,6H4V20a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V6h2a1,1,0,0,0,0-2ZM10,3a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V4H10ZM9,18a1,1,0,0,1-2,0V10a1,1,0,0,1,2,0Zm4,0a1,1,0,0,1-2,0V10a1,1,0,0,1,2,0Zm4,0a1,1,0,0,1-2,0V10a1,1,0,0,1,2,0Z"/>
                        </svg>Remover terra
                    </button>
                </div>
            </div>
        </main>
    </div>

    <div class="modalBackground" style="display: none;">
        <div class="modalContainer">
            <div class="titleCloseBtn">
                <button id="fecharBtn"> X </button>
            </div>
            <div class="title">
                <h1>Você tem certeza que você deseja remover essa Terra?</h1>
            </div>
            <div class="body">
                <p><strong>Atenção!</strong> Não será possível recuperar os registros depois.</p>
            </div>
            <div class="footer">
                <button><a href="{{ route('remover.terra', ['idTerra' => $terra->idTerra]) }}">Continuar</a></button>
                <button id="cancelBtn">Cancelar</button>
            </div>
        </div>
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
    $('#delete').on('click', function() {
        $('div.modalBackground').removeAttr('style');
    });

    $('#fecharBtn').on('click', function() {
        $('div.modalBackground').css('display', 'none');
    });

    $('#cancelBtn').on('click', function() {
        $('div.modalBackground').css('display', 'none');
    });

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
