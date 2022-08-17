@extends('layouts.main')
@section('title', 'Editar quiz - Abaeté')
@section('content')
<div id="root">
    <div id="page-form">
        <aside class="app-sidebar">
            <img src="{{ asset('images/map-marker.svg') }}" alt="Abaeté">

            <footer>
                <a href="{{ route('quizzes') }}" title="Voltar">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="rgba(0, 0, 0, 0.6)" height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="color: rgba(0, 0, 0, 0.6);">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
            </footer>
        </aside>

        <main>
            <form class="form-create-and-update" action="{{ route('editar.quiz') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="idQuiz" value="{{$quiz->idQuiz}}">
                <fieldset>
                    <legend>Dados</legend>
                    <div class="input-block field-group">
                        <div class="field">
                            <label for="terra">Terra relacionada</label>
                            <select name="terra" id="terra" required="">
                                @if($terras != null)
                                    <option value="">Selecione uma terra</option>
                                    @foreach($terras as $terra)
                                        @if($terra->idTerra == $quiz->terra)
                                        <option value="{{$terra->idTerra}}" selected="">{{$terra->nome}}</option>
                                        @else
                                        <option value="{{$terra->idTerra}}">{{$terra->nome}}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="" selected="">Cadastre terras, na página de cadastro de terra</option>
                                @endif
                            </select>
                        </div>
                        <div class="field">
                            <label for="tipo">Tipo</label>
                            <small style="color: #8FA7B3;">O tipo cadastrado é:
                                @if($quiz->tipo == 'alternativas')
                                    Alternativas.
                                @else
                                    Verdadeiro ou Falso.
                                @endif
                            </small>
                            <select name="tipo" id="tipo" required="">
                                <option value="" selected="">Selecione um tipo de quiz</option>
                                <option value="alternativas">Alternativas</option>
                                <option value="verdadeiro_ou_falso">Verdadeiro ou Falso</option>
                            </select>
                        </div>
                    </div>
                    <fieldset>
                        <div class="input-block field">
                            <label for="pergunta">Pergunta</label>
                            <input type="text" name="pergunta" id="pergunta" value="{{$quiz->pergunta}}" required="">
                        </div>

                        <div class="input-block field" id="verdadeiro_ou_falso" style="display: none;">
                            <label for="">Marque se é</label>

                            @switch($quiz->verdadeiro_ou_falso)
                                @case('1')
                                <label for="verdadeiro">
                                    <input type="radio" id="verdadeiro" name="verdadeiro_ou_falso" value="1" checked>
                                    <p class="verdadeiro">Verdadeiro</p>
                                </label>

                                <label for="falso">
                                    <input type="radio" id="falso" name="verdadeiro_ou_falso" value="0">
                                    <p class="falso">Falso</p>
                                </label>
                                @break

                                @case('0')
                                <label for="verdadeiro">
                                    <input type="radio" id="verdadeiro" name="verdadeiro_ou_falso" value="1">
                                    <p class="verdadeiro">Verdadeiro</p>
                                </label>

                                <label for="falso">
                                    <input type="radio" id="falso" name="verdadeiro_ou_falso" value="0" checked>
                                    <p class="falso">Falso</p>
                                </label>
                                @break

                                @default
                                <label for="verdadeiro">
                                    <input type="radio" id="verdadeiro" name="verdadeiro_ou_falso" value="1">
                                    <p class="verdadeiro">Verdadeiro</p>
                                </label>

                                <label for="falso">
                                    <input type="radio" id="falso" name="verdadeiro_ou_falso" value="0">
                                    <p class="falso">Falso</p>
                                </label>
                            @endswitch
                        </div>

                        <div class="input-block field" id="alternativas" style="display: none;">
                            <label for="alternativa_a">Alternativa A)</label>
                            <input type="text" name="alternativa_a" id="alternativa_a" value="{{$quiz->alternativa_a}}">

                            <label for="alternativa_b">Alternativa B)</label>
                            <input type="text" name="alternativa_b" id="alternativa_b" value="{{$quiz->alternativa_b}}">

                            <label for="alternativa_c">Alternativa C)</label>
                            <input type="text" name="alternativa_c" id="alternativa_c" value="{{$quiz->alternativa_c}}">

                            <br>

                            <label >Marque qual a alternativa correta:</label>
                            <label>
                                @switch($quiz->alternativa_correta)
                                    @case('A')
                                    <input type="radio" name="correta" value="A" checked>
                                    <p class="correta">Alternativa A)</p>

                                    <input type="radio" name="correta" value="B">
                                    <p class="correta">Alternativa B)</p>

                                    <input type="radio" name="correta" value="C">
                                    <p class="correta">Alternativa C)</p>
                                        @break
                                    @case('B')
                                    <input type="radio" name="correta" value="A">
                                    <p class="correta">Alternativa A)</p>

                                    <input type="radio" name="correta" value="B" checked>
                                    <p class="correta">Alternativa B)</p>

                                    <input type="radio" name="correta" value="C">
                                    <p class="correta">Alternativa C)</p>
                                        @break
                                    @case('C')
                                    <input type="radio" name="correta" value="A">
                                    <p class="correta">Alternativa A)</p>

                                    <input type="radio" name="correta" value="B">
                                    <p class="correta">Alternativa B)</p>

                                    <input type="radio" name="correta" value="C" checked>
                                    <p class="correta">Alternativa C)</p>
                                        @break
                                    @default
                                    <input type="radio" name="correta" value="A">
                                    <p class="correta">Alternativa A)</p>

                                    <input type="radio" name="correta" value="B">
                                    <p class="correta">Alternativa B)</p>

                                    <input type="radio" name="correta" value="C">
                                    <p class="correta">Alternativa C)</p>
                                @endswitch
                            </label>
                        </div>

                        <div class="input-block field">
                            <label for="pontos">Quantos pontos vale essa pergunta?</label>
                            <input type="number" name="pontos" id="pontos" value="{{$quiz->pontos}}" required="">
                        </div>
                    </fieldset>
                </fieldset>

                <button class="confirm-button" type="submit">Confirmar</button>
            </form>
        </main>
    </div>
</div>

<script>
    const APP_URL = `{{env('APP_URL')}}`;

    const API_URL = `{{env('APP_URL')}}` + `/api`;
</script>
<script src="<?=asset("js/criar-quiz.js")?>"></script>
@endsection
