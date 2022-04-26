@extends('master.master')

@section('content')
<div id="root">
    <div id="page-criar-aldeia">
        <aside class="app-sidebar">
            <img src="{{ asset('images/map-marker.svg') }}" alt="Abaeté">
            
            <footer>
                <a href="{{ route('terra-listar', ['idTerra' => $terra->idTerra]) }}" title="Voltar">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="rgba(0, 0, 0, 0.6)" height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="color: rgba(0, 0, 0, 0.6);">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                </footer>
            </aside>
            
            <main>
                <form class="criar-aldeia-form" action="{{ route('criar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <fieldset>
                        <legend>Dados</legend>
                        <fieldset>
                            <div class="input-block field">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="name" required="" value="{{$terra->nome}}">
                            </div>
                            <div class="input-block field-group">
                                <div class="field">
                                    <label for="populacao">População</label>
                                    <input type="number" name="populacao" id="populacao" required="" value="{{$terra->populacao}}">
                                </div>
                                <div class="field">
                                    <label for="povos">Povos</label>
                                    <input type="text" name="povos" id="povos" required="" value="{{$terra->povos}}">
                                </div>
                            </div>
                        </fieldset>
                        <div class="input-block field-group">
                            <div class="field">
                                <label for="lingua">Língua</label>
                                <input type="text" name="lingua" id="lingua" required="" value="{{$terra->lingua}}">
                            </div>
                            <div class="field">
                                <label for="modalidade">Modalidade</label>
                                <input type="text" name="modalidade" id="modalidade" required="" value="{{$terra->modalidade}}">
                            </div>
                        </div>
                        <div class="input-block field-group">
                            <div class="field">
                                <label for="uf">Estado (UF)</label>
                                <select name="uf" id="uf" required="">
                                    <option value="0" selected="">Selecione uma UF</option>

                                </select>
                            </div>
                            <div class="field">
                                <label for="city">Cidade</label>
                                <select name="city" id="city" required="">
                                    <option value="0" selected="">Selecione uma cidade</option>
                                </select>
                            </div>
                        </div>

                        <div id="map-container" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0" style="width: 100%; height: 280px; position: relative;">
                            
                        </div>

                        <input type="hidden" name="longitude" id="longitude" value="{{$terra->modalidade}}">
                        <input type="hidden" name="latitude" id="latitude" value="{{$terra->modalidade}}">
                        
                        <div class="input-block">
                            <label for="sobre">Sobre<span>Máximo de 3000 caracteres</span></label>
                            <textarea id="sobre" name="sobre" maxlength="3000" required="">{{$terra->sobre}}</textarea>
                        </div>
                        
                        <div class="input-block">
                            <label for="images">Fotos</label>
                            <div class="images-container">
                                <!-- Aqui acima do label vai as imagens... -->
                                <label for="images" class="new-image">
                                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="#15b6d6" height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="color: rgb(21, 182, 214);">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </label>
                                @if( count($terra->imagensTerra) > 1 )
                                        @foreach($terra->imagensTerra as $imagem)
                                            <img src="{{$imagem->url}}" alt="{{$terra->nome}}" class="remover" data-imagem="{{$imagem->idImagem}}" style="cursor: pointer;">
                                        @endforeach
                                @endif
                            </div>
                            <input type="file" id="images" name="images[]" multiple accept="image/*" required="">
                        </div>
                    </fieldset>
                    <button class="confirm-button" type="submit">Confirmar</button>
                </form>
            </main>
        </div>
    </div>
</div>

<script src="<?=asset('js/main.js')?>"></script>
<script src="<?=asset('js/mapIcon.js')?>"></script>
<script>
    // A variavel 'map' recebe a classe leaflet (l) ponto map
    // passando a div do mapa para tudo que for criado ser dentro dela
    // coloando a posição e também o nivel de zoom
    var map = L.map(document.getElementById('map-container'), {
        center: [<?=$terra->latitude?>,<?=$terra->longitude?>],
        zoom: 9
    });


    // Crio a variavel que vai ser a base do meu mapa e estou criando uma layer a partir do open street map
    var baseMap = L.tileLayer('https://a.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    });
    baseMap.addTo(map);


        // Cria o marcador no mapa.
    // Constantes que vai receber os input:hidden
    const inputLongitude = document.getElementById('longitude');
    const inputLatitude = document.getElementById('latitude');

    // Essa variával vai receber o marcador criado.
    var theMarker = {};


    theMarker = L.marker([<?=$terra->latitude?>,<?=$terra->longitude?>], {icon: abaeteMapIcon, interactive: false}).addTo(map);

    function onMapClick(e) {
        // Adiciono a latitude e longitude em cada um dos input.
        inputLatitude.value = e.latlng.lat;
        inputLongitude.value = e.latlng.lng;


        // Se o usuario já tive clicado no map. É removido o marcador antigo
        if (theMarker != undefined) {
            map.removeLayer(theMarker);
        };

        // Adiciona o marcador/icone estilizado ao local que o usuario clicou.
        theMarker = L.marker([e.latlng.lat, e.latlng.lng], {icon: abaeteMapIcon}).addTo(map);
    }

    map.on('click', onMapClick);



    $(function() {
        // Pré-visualização de várias imagens no navegador
        var visualizacaoImagens = function(input, lugarParaInserirVisualizacaoDeImagem) {

            if (input.files) {
                var quantImagens = input.files.length;

                for (i = 0; i < quantImagens; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img class="miniatura">')).attr('src', event.target.result).appendTo(lugarParaInserirVisualizacaoDeImagem);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#images').on('change', function() {
            visualizacaoImagens(this, 'div.images-container');
        });
    });

    $('img.remover').on('click', function() {
        let id = $(this).attr('data-imagem');
        let element = $(this);

        jQuery.get(`${APP_URL}terra/remover/imagem/${id}`, function(data){
            if (data.message == 'removido') {
                console.log('entrou para remover');
            } else {
                alert(data.message);
            }
        });
    });
</script>
@endsection