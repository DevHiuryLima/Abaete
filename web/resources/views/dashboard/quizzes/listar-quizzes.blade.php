@extends('layouts.main')
@section('title', 'Todas perguntas - Abaeté')
@section('content')
<div id="root">
    <div id="page-map">
        <aside>
            <header>
                <img src="{{ asset('images/map-marker.svg') }}" alt="Abaeté">
                <h2>Cadastre uma pergunta</h2>
                <p>Após, os cadastrados irão aparecer na tabela ao lado.</p>
            </header>
            <footer>
                <a onclick="history.back()" title="Voltar">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="rgba(0, 0, 0, 0.6)" height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="color: rgba(0, 0, 0, 0.6);">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
            </footer>
        </aside>

        <div class="container" style="width: 100%; height: 100%; position: relative; overflow-y: auto;">
            <h2></h2>
            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col col-1">Terra</div>
                    <div class="col col-1">Tipo</div>
                    <div class="col col-1">Pergunta</div>
                    <div class="col col-1">Alternativas</div>
                    <div class="col col-1">Resposta</div>
                    <div class="col col-1">Pontos</div>
                    <div class="col col-1">Ação</div>
                </li>
                @if ($quizzes != null)
                    @foreach($quizzes as $quiz)
                <li class="table-row">
                    <div class="col col-1" data-label="Terra">
                        {{$quiz->terra_relacionada != null ? $quiz->terra_relacionada->nome : 'Não possui'}}
                    </div>
                    <div class="col col-1" data-label="Tipo">
                        {{$quiz->tipo == 'alternativas' ? 'Alternativas' : 'Verdadeiro ou Falso'}}
                    </div>
                    <div class="col col-1" data-label="Pergunta">{{$quiz->pergunta}}</div>
                    <div class="col col-1" data-label="Alternativas">
                        @if($quiz->tipo == 'alternativas')
                        <p><b>A)</b> {{$quiz->alternativa_a}}</p><br>
                        <p><b>B)</b> {{$quiz->alternativa_b}}</p><br>
                        <p><b>C)</b> {{$quiz->alternativa_c}}</p>
                        @endif
                    </div>
                    <div class="col col-1" data-label="Resposta">
                    @switch($quiz->tipo)
                        @case('alternativas')
                            {{$quiz->alternativa_correta}}
                            @break

                        @case('verdadeiro_ou_falso')
                            {{$quiz->verdadeiro_ou_falso ? 'Verdadeiro' : 'Falso'}}
                            @break

                        @default
                    @endswitch
                    </div>
                    <div class="col col-1" data-label="Pontos">{{$quiz->pontos}}</div>
                    <div class="col col-1" data-label="Ação" style="display: flex; align-items: center;">
                        <button id="editar-quiz" title="Editar pergunta">
                            <a href="{{ route('redireciona.editar.quiz', ['idQuiz' => $quiz->idQuiz]) }}">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" color="#FFF" xmlns="http://www.w3.org/2000/svg" style="color: rgb(255, 255, 255);">
                                    <path d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path>
                                </svg>
                            </a>
                        </button>
                        <button id="remover-quiz" class="remover-quiz" title="Remover pergunta" data-quiz="{{$quiz->idQuiz}}">
                            <svg id="Icons" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <style>.cls-1{fill:#FFFFFF;}</style>
                                </defs>
                                <path class="cls-1" d="M22,4H16V3a3,3,0,0,0-3-3H11A3,3,0,0,0,8,3V4H2A1,1,0,0,0,2,6H4V20a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V6h2a1,1,0,0,0,0-2ZM10,3a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V4H10ZM9,18a1,1,0,0,1-2,0V10a1,1,0,0,1,2,0Zm4,0a1,1,0,0,1-2,0V10a1,1,0,0,1,2,0Zm4,0a1,1,0,0,1-2,0V10a1,1,0,0,1,2,0Z"/>
                            </svg>
                        </button>
                    </div>
                </li>
                    @endforeach
                @endif
            </ul>
        </div>


        <a class="criar-admin" href="{{ route('redireciona.criar.quiz') }}" title="Criar pergunta">
            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="#FFF" height="32" width="32" xmlns="http://www.w3.org/2000/svg" style="color: rgb(255, 255, 255);">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </a>
    </div>

    <div class="modalBackground" style="display: none;">
        <div class="modalContainer">
            <div class="titleCloseBtn">
                <button id="fecharBtn"> X </button>
            </div>
            <div class="title">
                <h1>Você tem certeza que você deseja remover essa pergunta?</h1>
            </div>
            <div class="body">
                <p><strong>Atenção!</strong> Não será possível recuperar os registros depois.</p>
            </div>
            <div class="footer">
                @csrf
                <input type="hidden" name="idQuiz" id="idQuiz">
                <button id="link-remover">Continuar</button>
                <button id="cancelBtn">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<script>
    $('.table-row > div > .remover-quiz').on('click', function() {
        var id = $(this).attr('data-quiz');
        $('#idQuiz').val(id);
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
        var id = $('#idQuiz').val();
        var token = $('input[name="_token"]').val();

        var json = {
            idQuiz: id,
            _token: token,
        };

        $.ajax({
            url: `{{ route('remover.quiz')}}`,
            type: 'POST',
            data: JSON.stringify(json),
            dataType: 'json',
            processData: false,
            contentType: "application/json; charset=UTF-8",
            success: function (resposta) {
                location.reload();
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
@endsection
