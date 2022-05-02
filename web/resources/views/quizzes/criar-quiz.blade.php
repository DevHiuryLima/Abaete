@extends('master.master')
@section('title', 'Criar administrador - Abaeté')
@section('content')
<div id="root">
    <div id="page-criar-aldeia">
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
                <form class="criar-aldeia-form" action="{{ route('criar.quiz') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <fieldset>
                        <legend>Dados</legend>
                        <div class="input-block field-group">
                            <div class="field">
                                <label for="terra">Terra relacionada</label>
                                <select name="terra" id="terra" required="">
                                    @if($terras != null)
                                        <option value="" selected="">Selecione uma terra</option>
                                        @foreach($terras as $terra)
                                        <option value="{{$terra->idTerra}}">{{$terra->nome}}</option>
                                        @endforeach
                                    @else
                                        <option value="" selected="">Cadastre terras na página de cadastro de terra</option>
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

                                <label >Marque qual a alternativa correta:</label>
                                <label>
                                    <input type="radio" name="correta" value="A">
                                    <p class="correta">Alternativa A)</p>

                                    <input type="radio" name="correta" value="B">
                                    <p class="correta">Alternativa B)</p>

                                    <input type="radio" name="correta" value="C">
                                    <p class="correta">Alternativa C)</p>
                                </label>
                            </div>

                            <div class="input-block field">
                                <label for="pontos">Quantos pontos vale essa pergunta?</label>
                                <input type="number" name="pontos" id="pontos" required="">
                            </div>




                            <!-- <div class="input-block field-group">
                                <div class="field">
                                    <label for="login">Login</label>
                                    <input type="text" name="login" id="login" required="">
                                </div>
                                <div class="field">
                                    <label for="senha">Senha</label>
                                    <input type="password" name="senha" id="senha" required="">
                                </div>
                            </div> -->
                        </fieldset>

                    </fieldset>
                    <button class="confirm-button" type="submit">Confirmar</button>
                </form>
            </main>
        </div>
    </div>
</div>

<script src="<?=asset('js/main.js')?>"></script>
<script src="<?= asset("js/criar-quiz.js")?>"></script>
@endsection