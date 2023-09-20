// Ao carregar a página cria-se os markers de terra no mapa.
$(window).on('load', function() {
    jQuery.get(API_URL + '/terras', function(data){

        data.forEach(terra => {
            var customPopup = `${terra.nome}<a href='${APP_URL+'/dashboard/terra/'+terra.idTerra}'><svg stroke='currentColor' fill='none' stroke-width='2' viewBox='0 0 24 24' stroke-linecap='round' stroke-linejoin='round' color='#FFF' height='20' width='20' xmlns='http://www.w3.org/2000/svg' style='color: rgb(255, 255, 255);'><line x1='5' y1='12' x2='19' y2='12'></line><polyline points='12 5 19 12 12 19'></polyline></svg></a>`;

            var customOptions = {
                closeButton: false,
                minWidth: 240,
                maxWidth: 240,
                className: 'map-popup'
            };


            L.marker([terra.latitude, terra.longitude], {icon: abaeteMapIcon}).bindPopup(customPopup, customOptions).addTo(map);
        });
    });
});
