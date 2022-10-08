// -------------------------------- Referente as duas parte de criação/edição --------------------------------

// Pega a interação no select de tipo de pergunta.
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






// -------------------------------- Referente somente a parte de criação --------------------------------






// -------------------------------- Referente somente a parte de edição ---------------------------------

// Ao carregar a página verifica no select de tipo de pergunta, e dependendo de qual opção estiver 
// marcada ele deixa os inputs dessa opção como 'visible'.
$(window).on('load', function() {
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