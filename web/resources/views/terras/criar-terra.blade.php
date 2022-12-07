@extends('layouts.main')
@section('title', 'Criar terra - Abaeté')
@section('content')
<div id="root">
    <div id="page-form">
        <aside class="app-sidebar">
            <img src="{{ asset('images/map-marker.svg') }}" alt="Abaeté">

            <footer>
                <a href="{{ route('terras') }}" title="Voltar">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="rgba(0, 0, 0, 0.6)" height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="color: rgba(0, 0, 0, 0.6);">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
            </footer>
        </aside>

        <main>
            <form name="formCriarTerra" class="form-create-and-update" action="{{ route('criar.terra') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <fieldset>
                    <legend>Dados</legend>
                    <fieldset>
                        <div class="input-block field">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" id="name" required="Selecione uma UF">
                        </div>
                        <div class="input-block field-group">
                            <div class="field">
                                <label for="populacao">População</label>
                                <input type="number" name="populacao" id="populacao" required="">
                            </div>
                            <div class="field">
                                <label for="povos">Povos</label>
                                <input type="text" name="povos" id="povos" required="">
                            </div>
                        </div>
                    </fieldset>
                    <div class="input-block field-group">
                        <div class="field">
                            <label for="lingua">Língua</label>
                            <input type="text" name="lingua" id="lingua" required="">
                        </div>
                        <div class="field">
                            <label for="modalidade">Modalidade</label>
                            <input type="text" name="modalidade" id="modalidade" required="">
                        </div>
                    </div>
                    <div class="input-block field-group">
                        <div class="field">
                            <label for="uf">Estado (UF)</label>
                            <select name="uf" id="uf" required="">
                                <option value="" selected="">Selecione uma UF</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="citys">Cidade</label>
                            <select name="citys[]" id="citys" multiple required="">
                                <option value="" selected="">Selecione uma cidade</option>
                            </select>
                            <small style="color: #8FA7B3;">
                                Aperte e segure a tecla ctrl para selecionar mais de uma cidade.
                            </small>
                        </div>
                    </div>

                    <div id="map-container" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0" style="width: 100%; height: 280px; position: relative;">

                    </div>

                    <input type="hidden" name="longitude" id="longitude">
                    <input type="hidden" name="latitude" id="latitude">

                    <div class="input-block">
                        <label for="sobre">Sobre<span>Máximo de 5000 caracteres</span></label>
                        <textarea id="sobre" name="sobre" maxlength="5000" required=""></textarea>
                    </div>

                    <div class="input-block">
                        <label for="images">Fotos</label>
                        <div class="images-container">
                            <!-- Aqui acima do label vai as imagens... -->
                            <label for="images" class="new-image">
                                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="#15b6d6" height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="color: rgb(21, 182, 214);">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </label>
                        </div>
                        <input type="file" id="images" name="images[]" multiple accept="image/*" >
                    </div>

                    <div class="input-block field-group">
                        <div class="field">
                            <label for="referencia">Referência das fotos</label>
                            <input type="text" name="referencia" id="referencia">
                        </div>
                    </div>
                </fieldset>
                <button class="confirm-button" type="submit">Confirmar</button>
            </form>
        </main>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/mapIcon.js') }}"></script>
<script src="{{ asset('js/carregar-mapa.js') }}"></script>
<script src="{{ asset('js/interacoes-no-form-de-terra.js') }}"></script>
<script src="{{ asset('js/busca-estados-e-municipios.js') }}"></script>
<script>
 $(function() {
     $('form[name="formCriarTerra"]').submit(function(event) {
         
         if ( ($('#latitude').val() == '') || ($('#longitude').val() == '') ) {
            event.preventDefault();
            return alert('Preencha no mapa a localização da Terra indígena.')
         }
     })
 });
</script>
@endpush
@endsection
