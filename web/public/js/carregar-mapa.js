// A variavel 'map' recebe a classe leaflet (l) ponto map
// passando a div do mapa para tudo que for criado ser dentro dela
// coloando a posição e também o nivel de zoom.
var map = L.map(document.getElementById('map-container'), {
    // center: [-16.6954999,-49.444356],
    center: [-16.6958288,-49.4443537],
    zoom: 7
});


// Crio a variavel que vai ser a base do meu mapa e estou criando uma layer a partir do open street map.
var baseMap = L.tileLayer('https://a.tile.openstreetmap.org/{z}/{x}/{y}.png', {
});
baseMap.addTo(map);