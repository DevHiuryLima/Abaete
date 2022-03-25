@extends('master.master')

@section('content')
<div id="root">
    <div id="page-criar-aldeia">
        <aside class="app-sidebar">
            <img src="<?= asset('images/map-marker.svg') ?>" alt="Abaeté">
            
            <footer>
                <a href="{{ route('terra-listar') }}">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="rgba(0, 0, 0, 0.6)" height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="color: rgba(0, 0, 0, 0.6);">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                </footer>
            </aside>
            
            <main>
                <form class="criar-aldeia-form">
                    <fieldset>
                        <legend>Dados</legend>
                        <fieldset>
                            <div class="input-block field">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="name" required="" value="">
                            </div>
                            <div class="input-block field-group">
                                <div class="field">
                                    <label for="populacao">População</label>
                                    <input type="text" name="populacao" id="populacao" required="" value="">
                                </div>
                                <div class="field">
                                    <label for="povos">Povos</label>
                                    <input type="text" name="povos" id="povos" required="" value="">
                                </div>
                            </div>
                        </fieldset>
                        <div class="input-block field-group">
                            <div class="field">
                                <label for="lingua">Língua</label>
                                <input type="text" name="lingua" id="lingua" required="" value="">
                            </div>
                            <div class="field">
                                <label for="modalidade">Modalidade</label>
                                <input type="text" name="modalidade" id="modalidade" required="" value="">
                            </div>
                        </div>
                        <div class="input-block field-group">
                            <div class="field">
                                <label for="uf">Estado (UF)</label>
                                <select name="uf" id="uf" required="">
                                    <option value="0">Selecione uma UF</option>
                                    <option value="RO">RO</option>
                                    <option value="AC">AC</option>
                                    <option value="AM">AM</option>
                                    <option value="RR">RR</option>
                                    <option value="PA">PA</option>
                                    <option value="AP">AP</option>
                                    <option value="TO">TO</option>
                                    <option value="MA">MA</option>
                                    <option value="PI">PI</option>
                                    <option value="CE">CE</option>
                                    <option value="RN">RN</option>
                                    <option value="PB">PB</option>
                                    <option value="PE">PE</option>
                                    <option value="AL">AL</option>
                                    <option value="SE">SE</option>
                                    <option value="BA">BA</option>
                                    <option value="MG">MG</option>
                                    <option value="ES">ES</option>
                                    <option value="RJ">RJ</option>
                                    <option value="SP">SP</option>
                                    <option value="PR">PR</option>
                                    <option value="SC">SC</option>
                                    <option value="RS">RS</option>
                                    <option value="MS">MS</option>
                                    <option value="MT">MT</option>
                                    <option value="GO">GO</option>
                                    <option value="DF">DF</option>
                                </select>
                            </div>
                            <div class="field">
                                <label for="city">Cidade</label>
                                <select name="city" id="city" required="">
                                    <option value="0">Selecione uma cidade</option>
                                </select>
                            </div>
                        </div>

                        <div id="map-container" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0" style="width: 100%; height: 280px; position: relative;">
                            
                        </div>
                        
                        <div class="input-block">
                            <label for="sobre">Sobre<span>Máximo de 3000 caracteres</span></label>
                            <textarea id="sobre" name="sobre" maxlength="3000" required=""></textarea>
                        </div>
                        
                        <div class="input-block">
                            <label for="images">Fotos</label>
                            <div class="images-container">
                                <!-- Aqui acima do label vai as imagens... -->
                                <label for="image[]" class="new-image">
                                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" color="#15b6d6" height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="color: rgb(21, 182, 214);">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </label>
                            </div>
                            <input multiple="" type="file" id="image[]" required="">
                        </div>
                    </fieldset>
                    <button class="confirm-button" type="submit">Confirmar</button>
                </form>
            </main>
        </div>
    </div>
</div>

<script>
    // A variavel 'map' recebe a classe leaflet (l) ponto map passando a div do mapa
    // para tudo que for criado ser dentro dela colocando a posição e também o nivel de zoom
    var map = L.map(document.getElementById('map-container'), {
        center: [-16.6954999,-49.444356], 
        zoom: 7
    });


    // Crio a variavel que vai ser a base do meu mapa e estou criando uma layer a partir do open street map
    var baseMap = L.tileLayer('https://a.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    });
    baseMap.addTo(map);
</script>
@endsection