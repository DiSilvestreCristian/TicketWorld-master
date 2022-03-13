@extends('layouts.struttura')

@section('title', 'Nuovo evento')

@section('breadcrumb')
    <li><a href="{{ route('org_area') }}">Area organizzatori</a></li>
    <li><a href="{{ route('nuovoEvento') }}">Nuovo evento</a></li>
@endsection

@section('content')
    <div id="container2">
       <div class="form_dati">
        <h3>Crea nuovo evento</h3>

        <div>
            <form enctype="multipart/form-data" action="{{route('creaEvento')}}" method="post">
                @csrf
                <label for="artista"><h6>Nome Artista</h6></label>
                <input type="text" id="artista" name="artista" value="{{old('artista')}}" required>
                @error('artista')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="data"><h6>Data</h6></label>
                <input type="date" id="data" name="data" value="{{old('data')}}" onkeypress="return false" required>
                @error('data')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="ora"><h6>Orario</h6></label>
                <input type="time" id="ora" name="ora" value="{{old('ora')}}" required>
                @error('ora')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="luogo"><h6>Luogo</h6></label>
                <input type="text" id="luogo" name="luogo" value="{{old('luogo')}}" required>
                @error('luogo')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="costo"><h6>Prezzo</h6></label>
                <input type="number" min="0.00" step="0.01" id="costo" name="costo" value="{{old('costo')}}" required>
                @error('costo')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br><br>
                <label for="sconto">Applicare sconto</label>
                <input type="checkbox" id="sconto_checkbox" onclick="showDiscount()" name="sconto">
                <div style="display: none" id="form_sconto">
                    <br><br>
                    <label for="percentuale_sconto">Percentuale di sconto </label>
                    <input style="width: 50px"  type="number" min="0" max="100" id="percentuale_sconto" name="percentuale_sconto" value="0" required> %
                    @error('percentuale_sconto')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <br><br>
                    <label for="giorni_sconto">Da applicare nei </label>
                    <input style="width: 50px" type="number" min="0" id="giorni_sconto" name="giorni_sconto" value="0" required> giorni precedenti l'evento
                    @error('giorni_sconto')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <br><br><br>
                <label for="programma"><h6>Programma</h6></label>
                <textarea style="width:590px;height:140px;"type="text" id="programma" name="programma">{{old('programma')}}</textarea>
                @error('programma')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="descrizione"><h6>Descrizione</h6></label>
                <textarea style="width:990px;height:120px;" type="text" id="descrizione" name="descrizione">{{old('descrizione')}}</textarea>
                @error('descrizione')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="regione"><h6>Regione</h6></label>
                <select class="" name="regione" id="regione" required>
                    <option value="">Seleziona regione</option>
                    <option value="Abruzzo">Abruzzo</option>
                    <option value="Basilicata">Basilicata</option>
                    <option value="Calabria">Calabria</option>
                    <option value="Campania">Campania</option>
                    <option value="Emilia Romagna">Emilia Romagna</option>
                    <option value="Friuli-Venezia Giulia">Friuli-Venezia Giulia</option>
                    <option value="Lazio">Lazio</option>
                    <option value="Liguria">Liguria</option>
                    <option value="Lombardia">Lombardia</option>
                    <option value="Marche">Marche</option>
                    <option value="Molise">Molise</option>
                    <option value="Piemonte">Piemonte</option>
                    <option value="Puglia">Puglia</option>
                    <option value="Sardegna">Sardegna</option>
                    <option value="Sicilia">Sicilia</option>
                    <option value="Toscana">Toscana</option>
                    <option value="Trentino-Alto Adige">Trentino-Alto Adige</option>
                    <option value="Umbria">Umbria</option>
                    <option value="Val d'Aosta">Val d'Aosta</option>
                    <option value="Veneto">Veneto</option>
                </select>
                @error('regione')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="indicazioni"><h6>Indicazioni</h6></label>
                <textarea style="width:885px;height:140px;" type="text" id="indicazioni" name="indicazioni">{{old('indicazioni')}}</textarea>
                @error('indicazioni')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="biglietti_totali"><h6>Biglietti Totali</h6></label>
                <input type="number" id="biglietti_totali" name="biglietti_totali" min="1" value="{{old('biglietti_totali')}}" required>
                @error('biglietti_totali')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="image_catalogo"><h6>Immagine Catalogo</h6></label>
                <input type="file" id="image_catalogo" name="image_catalogo">
                @if ($errors->first('image_catalogo'))
                    <ul class="errors">
                        @foreach ($errors->get('image_catalogo') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
                <br><br>

                <input class="form_btn" type="submit" value="Crea">
            </form>

            <script>
                function showDiscount() {
                    var checkbox = document.getElementById("sconto_checkbox");
                    var form = document.getElementById("form_sconto");
                    if(checkbox.checked == true)
                    form.style.display = "block";
                    else form.style.display = "none";
                }
            </script>

        </div>
      </div>
    </div>

@endsection
