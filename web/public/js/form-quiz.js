// -------------------------------- Referente as duas parte de criação/edição --------------------------------

// Pega a interação no select de tipo de pergunta.
$('#tipo').on('change', function() {    
    switch ($('#tipo option:selected').val()) {
        case 'alternativas':
            // Removendo o 'display none' para aparecer os campos de alternativas.
            $('#alternativas').removeAttr('style');

            // Adicionando o atributo required para os campos de alternativas.
            $('#alternativa_a').prop('required',true);
            $('#alternativa_b').prop('required',true);
            $('#alternativa_c').prop('required',true);
            $('#correta_a').prop('required',true);



            // Adicionando o display none para os campos de verdadeiro ou falso ficar escondido.
            $('#verdadeiro_ou_falso').attr('style', 'display: none;');

            // Removendo o atributo 'required' do campos de verdadeiro ou falso para não ser obrigatório.
            $('#verdadeiro').removeAttr('required');
            break;


        case 'verdadeiro_ou_falso':
            // Removendo o 'display none' para aparecer os campos de vercadeiro ou falsos.
            $('#verdadeiro_ou_falso').removeAttr('style');

            // Adicionando o atributo required para os campos de verdadeiro ou falsos.
            $('#verdadeiro').prop('required',true);


            
            // Adicionando o display none para os campos de alternativas ficar escondido.
            $('#alternativas').attr('style', 'display: none;');

            // Removendo o atributo 'required' do campos de verdadeiro ou falso para não ser obrigatório.
            $('#alternativa_a').removeAttr('required');
            $('#alternativa_b').removeAttr('required');
            $('#alternativa_c').removeAttr('required');
            $('#correta_a').removeAttr('required');
            break;


        default:
            $('#alternativas').removeAttr('style');
            $('#alternativas').attr('style', 'display: none;');

            // Removendo o atributo 'required' do campos de verdadeiro ou falso para não ser obrigatório.
            $('#alternativa_a').removeAttr('required');
            $('#alternativa_b').removeAttr('required');
            $('#alternativa_c').removeAttr('required');
            $('#correta_a').removeAttr('required');


            
            $('#verdadeiro_ou_falso').removeAttr('style');
            $('#verdadeiro_ou_falso').attr('style', 'display: none;');

            // Removendo o atributo 'required' do campos de verdadeiro ou falso para não ser obrigatório.
            $('#verdadeiro').removeAttr('required');
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
            // Removendo o 'display none' para aparecer os campos de alternativas.
            $('#alternativas').removeAttr('style');

            // Adicionando o atributo required para os campos de alternativas.
            $('#alternativa_a').prop('required',true);
            $('#alternativa_b').prop('required',true);
            $('#alternativa_c').prop('required',true);
            $('#correta_a').prop('required',true);



            // Adicionando o display none para os campos de verdadeiro ou falso ficar escondido.
            $('#verdadeiro_ou_falso').attr('style', 'display: none;');

            // Removendo o atributo 'required' do campos de verdadeiro ou falso para não ser obrigatório.
            $('#verdadeiro').removeAttr('required');
            break;


        case 'verdadeiro_ou_falso':
            // Removendo o 'display none' para aparecer os campos de vercadeiro ou falsos.
            $('#verdadeiro_ou_falso').removeAttr('style');

            // Adicionando o atributo required para os campos de verdadeiro ou falsos.
            $('#verdadeiro').prop('required',true);


            
            // Adicionando o display none para os campos de alternativas ficar escondido.
            $('#alternativas').attr('style', 'display: none;');

            // Removendo o atributo 'required' do campos de verdadeiro ou falso para não ser obrigatório.
            $('#alternativa_a').removeAttr('required');
            $('#alternativa_b').removeAttr('required');
            $('#alternativa_c').removeAttr('required');
            $('#correta_a').removeAttr('required');
            break;


        default:
            $('#alternativas').removeAttr('style');
            $('#alternativas').attr('style', 'display: none;');

            // Removendo o atributo 'required' do campos de verdadeiro ou falso para não ser obrigatório.
            $('#alternativa_a').removeAttr('required');
            $('#alternativa_b').removeAttr('required');
            $('#alternativa_c').removeAttr('required');
            $('#correta_a').removeAttr('required');


            
            $('#verdadeiro_ou_falso').removeAttr('style');
            $('#verdadeiro_ou_falso').attr('style', 'display: none;');

            // Removendo o atributo 'required' do campos de verdadeiro ou falso para não ser obrigatório.
            $('#verdadeiro').removeAttr('required');
            break;
    }
})