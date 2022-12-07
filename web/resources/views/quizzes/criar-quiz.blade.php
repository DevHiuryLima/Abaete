@extends('layouts.main')
@section('title', 'Criar administrador - Abaeté')
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
            <form class="form-create-and-update" action="{{ route('criar.quiz') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <fieldset>
                    <legend>Dados</legend>
                    <div class="input-block field-group">
                        <div class="field">
                            <label for="terra">Terra relacionada</label>
                            <select name="terra" id="terra" required="">
                                @if($terras != null)
                                    <option value="" selected="">Selecione uma terra</option>
                                    <option value="">Geral</option>
                                    @foreach($terras as $terra)
                                    <option value="{{$terra->idTerra}}">{{$terra->nome}}</option>
                                    @endforeach
                                @else
                                    <option value="" selected="">Cadastre terras, na página de cadastro de terra</option>
                                @endif
                            </select>
                        </div>
                        <div class="field">
                            <label for="tipo">Tipo</label>
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
                            <input type="text" name="pergunta" id="pergunta" required="">
                        </div>

                        <div class="input-block field" id="verdadeiro_ou_falso" style="display: none;">
                            <label for="">Marque se é</label>

                            <label for="verdadeiro">
                                <input type="radio" id="verdadeiro" name="verdadeiro_ou_falso" value="1">
                                <p class="verdadeiro">Verdadeiro</p>
                            </label>

                            <label for="falso">
                                <input type="radio" id="falso" name="verdadeiro_ou_falso" value="0">
                                <p class="falso">Falso</p>
                            </label>
                        </div>

                        <div class="input-block field" id="alternativas" style="display: none;">
                            <label for="alternativa_a">Alternativa A)</label>
                            <input type="text" name="alternativa_a" id="alternativa_a">

                            <label for="alternativa_b">Alternativa B)</label>
                            <input type="text" name="alternativa_b" id="alternativa_b">

                            <label for="alternativa_c">Alternativa C)</label>
                            <input type="text" name="alternativa_c" id="alternativa_c">

                            <br>

                            <p id="texto-alternativa-correta">Marque qual a alternativa correta:</p>
                            <div id="inputs-alternativa-correta">
                                <input type="radio" name="correta" value="A" id="correta_a">
                                <label for="correta_a" class="correta">Alternativa A)</label>

                                <input type="radio" name="correta" value="B" id="correta_b">
                                <label for="correta_b" class="correta">Alternativa B)</label>

                                <input type="radio" name="correta" value="C" id="correta_c">
                                <label for="correta_c" class="correta">Alternativa C)</label>
                            </div>
                        </div>

                        <div class="input-block field">
                            <label for="pontos">Quantos pontos vale essa pergunta?</label>
                            <input type="number" name="pontos" id="pontos" min="1" max="100" required="">
                        </div>
                    </fieldset>
                </fieldset>

                <button class="confirm-button" type="submit">Confirmar</button>
            </form>
        </main>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/form-quiz.js') }}"></script>
@endpush
@endsection
