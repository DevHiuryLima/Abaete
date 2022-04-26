$('#tipo').on('change', function() {    
    switch ($('#tipo option:selected').val()) {
        case 'alternativas':
            $('#verdadeiro_ou_falso').attr('style', 'display: none;');
            $('#alternativas').removeAttr('style');
            break;
        case 'verdadeiro_ou_falso':
            $('#alternativas').attr('style', 'display: none;');
            $('#verdadeiro_ou_falso').removeAttr('style');
            break;
        default:
            $('#alternativas').removeAttr('style');
            $('#verdadeiro_ou_falso').removeAttr('style');

            $('#alternativas').attr('style', 'display: none;');
            $('#verdadeiro_ou_falso').attr('style', 'display: none;');
            break;
    }
})