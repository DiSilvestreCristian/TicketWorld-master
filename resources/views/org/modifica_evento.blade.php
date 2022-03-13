@extends('layouts.struttura')

@section('title', 'Modifica evento')

@section('breadcrumb')
    <li><a href="{{ route('org_area') }}">Area organizzatori</a></li>
    <li><a href="{{ route('modificaEvento', $dati->event_id) }}">Modifica evento</a></li>
@endsection

@section('content')
    <div id="container2">
      <div class="form_dati">
        <h3>Modifica i dati dell'evento</h3>

        <div>
            <form enctype="multipart/form-data" action="{{route('modEvento')}}" method="post">
                @csrf

                <input value="{{$dati->event_id}}" type="hidden" id="event_id" name="event_id" required>
                <br><br>
                <label for="artista"><h6>Nome Artista</h6></label>
                <input value="{{$dati->artista}}" type="text" id="artista" name="artista" required>
                @error('artista')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="data"><h6>Data</h6></label>
                <input value="{{$dati->data}}" type="date" id="data" name="data" onkeypress="return false" required>
                @error('data')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="ora"><h6>Orario</h6></label>
                <input value="{{$dati->ora}}" type="time" id="ora" name="ora" required>
                @error('ora')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="luogo"><h6>Luogo</h6></label>
                <input value="{{$dati->luogo}}" type="text" id="luogo" name="luogo" required>
                @error('luogo')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="costo"><h6>Prezzo</h6></label>
                <input value="{{$dati->costo}}" min="0.00" step="0.01" type="number" id="costo" name="costo" required>
                @error('costo')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <div>
                    <br><br>
                    <label for="percentuale_sconto">Percentuale di sconto </label>
                    <input style="width: 50px"  type="number" min="0" max="100" id="percentuale_sconto" name="percentuale_sconto" value="{{ $dati->percentuale_sconto }}" required> %
                    @error('percentuale_sconto')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <br><br>
                    <label for="giorni_sconto">Da applicare nei </label>
                    <input style="width: 50px" type="number" min="0" id="giorni_sconto" name="giorni_sconto" value="{{ $dati->giorni_sconto }}" required> giorni precedenti l'evento
                    @error('giorni_sconto')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <br><br>
                <label for="programma"><h6>Programma</h6></label>
                <textarea style="width:590px;height:140px;" type="text" id="programma" name="programma">{{$dati->programma}} </textarea>
                @error('programma')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="descrizione"><h6>Descrizione</h6></label>
                <textarea style="width:990px;height:120px;" type="text" id="descrizione" name="descrizione">{{$dati->descrizione}} </textarea>
                @error('descrizione')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="regione"><h6>Regione</h6></label>
                <select class="" name="regione">
                    <option value="">Seleziona regione</option>
                    <option value="Abruzzo" @if($dati->regione=='Abruzzo') selected @endif>Abruzzo</option>
                    <option value="Basilicata" @if($dati->regione=='Basilicata') selected @endif>Basilicata</option>
                    <option value="Calabria" @if($dati->regione=='Calabria') selected @endif>Calabria</option>
                    <option value="Campania" @if($dati->regione=='Campania') selected @endif>Campania</option>
                    <option value="Emilia Romagna" @if($dati->regione=='Emilia Romagna') selected @endif>Emilia Romagna</option>
                    <option value="Friuli-Venezia Giulia" @if($dati->regione=='Friuli-Venezia Giulia')selected @endif>Friuli-Venezia Giulia</option>
                    <option value="Lazio" @if($dati->regione=='Lazio') selected @endif>Lazio</option>
                    <option value="Liguria" @if($dati->regione=='Liguria') selected @endif>Liguria</option>
                    <option value="Lombardia" @if($dati->regione=='Lombardia') selected @endif>Lombardia</option>
                    <option value="Marche" @if($dati->regione=='Marche') selected @endif>Marche</option>
                    <option value="Molise" @if($dati->regione=='Molise') selected @endif>Molise</option>
                    <option value="Piemonte" @if($dati->regione=='Piemonte') selected @endif>Piemonte</option>
                    <option value="Puglia" @if($dati->regione=='Puglia') selected @endif>Puglia</option>
                    <option value="Sardegna" @if($dati->regione=='Sardegna') selected @endif>Sardegna</option>
                    <option value="Sicilia" @if($dati->regione=='Sicilia') selected @endif>Sicilia</option>
                    <option value="Toscana" @if($dati->regione=='Toscana') selected @endif>Toscana</option>
                    <option value="Trentino-Alto Adige" @if($dati->regione=='Trentino-Alto Adige') selected @endif>Trentino-Alto Adige</option>
                    <option value="Umbria" @if($dati->regione=='Umbria') selected @endif>Umbria</option>
                    <option value="Val d'Aosta" @if($dati->regione=="Val d'Aosta") selected @endif>Val d'Aosta</option>
                    <option value="Veneto" @if($dati->regione=='Veneto') selected @endif>Veneto</option>
                </select>
                @error('regione')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="indicazioni"><h6>Indicazioni</h6></label>
                <textarea style="width:885px;height:140px;" type="text" id="indicazioni" name="indicazioni">{{$dati->indicazioni}} </textarea>
                @error('indicazioni')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="biglietti_totali"><h6>Biglietti Totali Acquistabili</h6></label>
                <input value="{{$dati->biglietti_totali}}" type="number" id="biglietti_totali" name="biglietti_totali" required>
                @error('biglietti_totali')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <br><br>
                <label for="image_catalogo"><h6>Immagine Visualizzata nel Catalogo</h6></label>
                <input value="{{$dati->image_catalogo}}" type="file" id="image_catalogo" name="image_catalogo">
                @if ($errors->first('image_catalogo'))
                    <ul class="errors">
                        @foreach ($errors->get('image_catalogo') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
                <br><br>


                <input class="form_btn" type="submit" value="Modifica">
            </form>
        </div>
      </div>
    </div>

@endsection
