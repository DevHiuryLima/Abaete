@extends('layouts.main')
@section('title', 'Editar terra - Abaeté')
@section('content')
<div id="root">
    <div id="page-form">
        <aside class="app-sidebar">
            <img src="{{ asset('images/map-marker.svg') }}" alt="Abaeté">

            <footer>
                <a href="{{ route('listar.terra', ['idTerra' => $terra->idTerra]) }}" title="Voltar">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="rgba(0, 0, 0, 0.6)" height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="color: rgba(0, 0, 0, 0.6);">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
            </footer>
        </aside>

        <main>
            <form name="formEditarTerra" class="form-create-and-update" action="{{ route('editar.terra') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="idTerra" value="{{$terra->idTerra}}">
                <fieldset>
                    <legend>Dados</legend>
                    <fieldset>
                        <div class="input-block field">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" id="name" value="{{$terra->nome}}" required="">
                        </div>
                        <div class="input-block field-group">
                            <div class="field">
                                <label for="populacao">População</label>
                                @php
                                    $retirar = array(" Pessoas", " Pessoa");
                                    $populacao = str_replace($retirar, '', $terra->populacao);
                                @endphp
                                <input type="number" name="populacao" id="populacao" value="{{$populacao}}" required="">
                            </div>
                            <div class="field">
                                <label for="povos">Povos</label>
                                <input type="text" name="povos" id="povos" value="{{$terra->povos}}" required="">
                            </div>
                        </div>
                    </fieldset>
                    <div class="input-block field-group">
                        <div class="field">
                            <label for="lingua">Língua</label>
                            <input type="text" name="lingua" id="lingua" value="{{$terra->lingua}}" required="">
                        </div>
                        <div class="field">
                            <label for="modalidade">Modalidade</label>
                            <input type="text" name="modalidade" id="modalidade" value="{{$terra->modalidade}}" required="">
                        </div>
                    </div>
                    <div class="input-block field-group">
                        <div class="field">
                            <label for="uf">Estado (UF)</label>
                            <small style="color: #8FA7B3;">O estado cadastrado é: {{$terra->estado}}</small>
                            <select name="uf" id="uf" required="">
                                <option value="" selected="">Selecione uma UF</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="citys">Cidade</label>
                            <small style="color: #8FA7B3;">
                                As cidades cadastrada são:
                                @foreach($terra->cidades as $cidade)
                                    - {{$cidade->cidade}}.
                                @endforeach
                            </small>
                            <select name="citys[]" id="citys" multiple required="">
                                <option value="" selected="">Selecione uma cidade</option>
                            </select>
                            <small style="color: #8FA7B3;">
                                Aperte e segure a tecla ctrl para selecionar mais de uma cidade.
                            </small>
                        </div>
                    </div>

                    <div id="map-container" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0" style="width: 100%; height: 280px; position: relative;">

                    </div>

                    <input type="hidden" name="latitude" id="latitude" value="{{$terra->latitude}}">
                    <input type="hidden" name="longitude" id="longitude" value="{{$terra->longitude}}">

                    <div class="input-block">
                        <label for="sobre">Sobre<span>Máximo de 5000 caracteres</span></label>
                        <textarea id="sobre" name="sobre" maxlength="5000" required="">{{$terra->sobre}}</textarea>
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
                            @if( count($terra->imagensTerra) >= 1 )
                                    @foreach($terra->imagensTerra as $imagem)
                                        <img src="{{env('APP_URL') . '/storage/' . $imagem->url}}" alt="{{$terra->nome}}" class="remover-imagem" data-imagem="{{$imagem->idImagem}}" title="Remover imagem" style="cursor: pointer;">
                                    @endforeach
                            @endif
                        </div>
                        <input type="file" id="images" name="images[]" multiple accept="image/*">
                    </div>
                </fieldset>
                <button class="confirm-button" type="submit">Confirmar</button>
            </form>
        </main>
    </div>

    <div class="modalBackground" style="display: none;">
        <div class="modalContainer">
            <div class="titleCloseBtn">
                <button id="fecharBtn"> X </button>
            </div>
            <div class="title">
                <h1>Você tem certeza que você deseja remover essa Imagem?</h1>
            </div>
            <div class="body">
                <p><strong>Atenção!</strong> Não será possível recuperar o registro depois.</p>
            </div>
            <div class="footer">
                @csrf
                <input type="hidden" name="idImagem" id="idImagem">
                <button id="link-remover">Continuar</button>
                <button id="cancelBtn">Cancelar</button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script src="{{ asset('js/mapIcon.js') }}"></script>
<script src="{{ asset('js/busca-estados-e-municipios.js') }}"></script>
<script>
    //Esse script está local pois nescessita pegar a latitude e longitude da terra para ser colocada no mapa.

    // A variavel 'map' recebe a classe leaflet (l) ponto map
    // passando a div do mapa para tudo que for criado ser dentro dela
    // coloando a posição e também o nivel de zoom
    var map = L.map(document.getElementById('map-container'), {
        center: [ {{$terra->latitude}},{{$terra->longitude}} ],
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


    theMarker = L.marker([ {{$terra->latitude}}, {{$terra->longitude}} ], {icon: abaeteMapIcon, interactive: false}).addTo(map);

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
</script>
<script>
    $('.input-block > .images-container > .remover-imagem').on('click', function() {
        var id = $(this).attr('data-imagem');
        $('#idImagem').val(id);
        $('div.modalBackground').removeAttr('style');
    });

    $('#fecharBtn').on('click', function() {
        $('div.modalBackground').css('display', 'none');
    });

    $('#cancelBtn').on('click', function() {
        $('div.modalBackground').css('display', 'none');
    });
</script>
<script>
    $('#link-remover').on('click', function(envent) {
        event.preventDefault();
        var id = $('#idImagem').val();
        var token = $('input[name="_token"]').val();

        var json = {
            idImagem: id,
            _token: token,
        };

        $.ajax({
            url: `{{ route('remover.imagem')}}`,
            type: 'POST',
            data: JSON.stringify(json),
            dataType: 'json',
            processData: false,
            contentType: "application/json; charset=UTF-8",
            success: function (resposta) {
                $('div.modalBackground').css('display', 'none');
                $(`img[data-imagem='${id}']`).remove();
            }
        })
        .fail(function(resposta){
            if ((resposta.status == 404) || (resposta.status == 422)) {
                alert(resposta.responseJSON.message);
            } else if (resposta.status == 500) {
                alert('Ocorreu um erro interno!\n\n' + resposta.responseJSON.message);
            } else {
                alert('Ocorreu um erro ao tentar remover!\n\n' + resposta.responseJSON.message);
            }
        });
    });
</script>
<script>
 $(function() {
     $('form[name="formEditarTerra"]').submit(function(event) {
         
         if ( ($('#latitude').val() == '') || ($('#longitude').val() == '') ) {
            event.preventDefault();
            return alert('Preencha no mapa a localização da Terra indígena.')
         }
     })
 });
</script>
@endpush
@endsection
