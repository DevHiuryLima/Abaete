// Ao carregar a página cria também as tag option dentro do select de estado, buscando da api governamental.
$(window).on("load", function() {
    jQuery.get(`https://servicodados.ibge.gov.br/api/v1/localidades/estados`, function(data){
        data.forEach(uf => {
            $("#uf").append(`<option value="${uf.sigla}">${uf.nome}</option>`)
        });
    }); 
});

// Ao usuário selecionar o estado carrega todas as cidades daquele estado, buscando da api governamental. 
$("#uf").on("change", function() {
    let estadoSelecionado = $('#uf').find(":selected").val();

    if (estadoSelecionado == '0') {
        return;
    }

    $("#city").empty();
    $("#city").append(`<option value="0">Selecione uma cidade</option>`);

    jQuery.get(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estadoSelecionado}/municipios`, function(data){
        data.forEach(city => {
            $("#city").append(`<option value="${city.nome}">${city.nome}</option>`);
        });
    }); 
});










// Cria o marcador no mapa.
// Constantes que vai receber os input:hidden
const inputLongitude = document.getElementById('longitude');
const inputLatitude = document.getElementById('latitude');

// Essa variával vai receber o marcador criado.
var theMarker = {};
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










