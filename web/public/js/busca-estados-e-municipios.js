// Ao carregar a página cria também as tag option dentro do select de estado, buscando da api governamental.
$(window).on('load', function() {
    jQuery.get(`https://servicodados.ibge.gov.br/api/v1/localidades/estados`, function(data){
        data.forEach(uf => {
            $('#uf').append(`<option value='${uf.sigla}'>${uf.nome}</option>`)
        });
    }); 
});

// Ao usuário selecionar o estado carrega todas as cidades daquele estado, buscando da api governamental. 
$('#uf').on('change', function() {
    let estadoSelecionado = $('#uf').find(':selected').val();

    if (estadoSelecionado == '') {
        return;
    }

    $('#city').empty();
    $('#city').append(`<option value=''>Selecione uma cidade</option>`);

    jQuery.get(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estadoSelecionado}/municipios`, function(data){
        data.forEach(city => {
            $('#city').append(`<option value='${city.nome}'>${city.nome}</option>`);
        });
    }); 
});