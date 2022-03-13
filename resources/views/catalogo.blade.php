@extends('layouts.struttura')

@section('title', 'Catalogo')

@section('breadcrumb')
    <li><a href="{{ route('showCatalog') }}">Catalogo</a></li>
@endsection

@section('content')

    <div id="container2">

        <!-- CATALOGO -->
        <div id="contenuto_catalogo">

            @if($eventi->total() == 1)
                <h4 style="margin: 10px auto auto 350px;">1 EVENTO</h4>
            @else
                <h4 style="margin: 10px auto auto 350px;">{{ $eventi->total() }} EVENTI</h4>
            @endif

            <ul>
                <div style="display: none">{{ $i = 0 }}</div>
                @foreach($eventi as $concerto)
                    <li id="elemento_lista">
                        <div class="riquadro_concerto">
                            <div><img src="{{ asset('images/' . $concerto->image_catalogo) }}" alt="" class="immagine_concerto"> </div>
                            <div class="testo_concerto">
                                <h4>{{ $concerto->artista }}</h4>
                                <br>Data: {{ date("d/m/Y", strtotime($concerto->data)) }} - Ora: {{ substr($concerto->ora, 0, -3) }}
                                <br>Luogo: {{$concerto ->regione}} - {{ $concerto->luogo }}
                                @if($sconti[$i][0] == 0)
                                <br>Prezzo: €{{ bcadd($concerto->costo, 0.00, 2) }}
                                @else
                                <br>Prezzo: <strike>€{{ bcadd($concerto->costo, 0.00, 2) }}</strike> €{{ bcadd($sconti[$i][1], 0.00, 2) }}
                                @endif
                                <br>Organizzatore: {{ $concerto->org_name }}
                                <div style="display: none">{{ ++$i }}</div>
                            <!-- Titolo, Data, Luogo, Prezzo-->
                            </div>
                            <div class="bottone_acquista">
                                <a href=" {{ route('eventDetails', [$concerto->event_id]) }}"><button name="button" class="lgn_btn">Dettagli</button></a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <!--Paginazione-->
            @include('pagination.paginator', ['paginator' => $eventi])

        </div>

        <!-- FILTRI -->
        <div class="catalog">
            <aside id="sidebar">
                <div style="margin-left: 10px">
                    <br>
                    <h3>Filtri</h3>
                    <form class="" action="{{ route('processForm') }}" method="post">
                        @csrf
                        <fieldset>
                            <legend>Descrizione dell'evento</legend>
                            <input @isset($filtri) value="{{ $filtri['descrizione'] }}" @endisset type="text" class="search-input" style="width: 200px" maxlength="50" name="descrizione" placeholder="Descrizione">
                        </fieldset>
                        <fieldset class="select_mese">
                            <legend>Scegli la data (mese e/o anno)</legend>
                            <select class="select-input" name="mese">
                                <option value="" >Seleziona mese</option>
                                <option value="01" @isset($filtri) @if($filtri['mese']=='01') selected @endif @endisset>Gennaio</option>
                                <option value="02" @isset($filtri) @if($filtri['mese']=='02') selected @endif @endisset>Febbraio</option>
                                <option value="03" @isset($filtri) @if($filtri['mese']=='03') selected @endif @endisset>Marzo</option>
                                <option value="04" @isset($filtri) @if($filtri['mese']=='04') selected @endif @endisset>Aprile</option>
                                <option value="05" @isset($filtri) @if($filtri['mese']=='05') selected @endif @endisset>Maggio</option>
                                <option value="06" @isset($filtri) @if($filtri['mese']=='06') selected @endif @endisset>Giugno</option>
                                <option value="07" @isset($filtri) @if($filtri['mese']=='07') selected @endif @endisset>Luglio</option>
                                <option value="08" @isset($filtri) @if($filtri['mese']=='08') selected @endif @endisset>Agosto</option>
                                <option value="09" @isset($filtri) @if($filtri['mese']=='09') selected @endif @endisset>Settembre</option>
                                <option value="10" @isset($filtri) @if($filtri['mese']=='10') selected @endif @endisset>Ottobre</option>
                                <option value="11" @isset($filtri) @if($filtri['mese']=='11') selected @endif @endisset>Novembre</option>
                                <option value="12" @isset($filtri) @if($filtri['mese']=='12') selected @endif @endisset>Dicembre</option>
                            </select>
                            <select class="select-input" name="anno">
                                <option value="">Seleziona anno</option>
                                <option value="2021" @isset($filtri) @if($filtri['anno']=='2021') selected @endif @endisset>2021</option>
                                <option value="2022" @isset($filtri) @if($filtri['anno']=='2022') selected @endif @endisset>2022</option>
                                <option value="2023" @isset($filtri) @if($filtri['anno']=='2023') selected @endif @endisset>2023</option>
                            </select>
                        </fieldset>
                        <fieldset>
                            <legend>Scegli il luogo (regione)</legend>
                            <select class="select-input" name="regione">
                                <option value="">Seleziona regione</option>
                                <option value="Abruzzo" @isset($filtri) @if($filtri['regione']=='Abruzzo') selected @endif @endisset>Abruzzo</option>
                                <option value="Basilicata" @isset($filtri) @if($filtri['regione']=='Basilicata') selected @endif @endisset>Basilicata</option>
                                <option value="Calabria" @isset($filtri) @if($filtri['regione']=='Calabria') selected @endif @endisset>Calabria</option>
                                <option value="Campania" @isset($filtri) @if($filtri['regione']=='Campania') selected @endif @endisset>Campania</option>
                                <option value="Emilia Romagna" @isset($filtri) @if($filtri['regione']=='Emilia Romagna') selected @endif @endisset>Emilia Romagna</option>
                                <option value="Friuli-Venezia Giulia" @isset($filtri) @if($filtri['regione']=='Friuli-Venezia Giulia')selected @endif @endisset>Friuli-Venezia Giulia</option>
                                <option value="Lazio" @isset($filtri) @if($filtri['regione']=='Lazio') selected @endif @endisset>Lazio</option>
                                <option value="Liguria" @isset($filtri) @if($filtri['regione']=='Liguria') selected @endif @endisset>Liguria</option>
                                <option value="Lombardia" @isset($filtri) @if($filtri['regione']=='Lombardia') selected @endif @endisset>Lombardia</option>
                                <option value="Marche" @isset($filtri ) @if($filtri['regione']=='Marche') selected @endif @endisset>Marche</option>
                                <option value="Molise" @isset($filtri) @if($filtri['regione']=='Molise') selected @endif @endisset>Molise</option>
                                <option value="Piemonte" @isset($filtri) @if($filtri['regione']=='Piemonte') selected @endif @endisset>Piemonte</option>
                                <option value="Puglia" @isset($filtri) @if($filtri['regione']=='Puglia') selected @endif @endisset>Puglia</option>
                                <option value="Sardegna" @isset($filtri) @if($filtri['regione']=='Sardegna') selected @endif @endisset>Sardegna</option>
                                <option value="Sicilia" @isset($filtri) @if($filtri['regione']=='Sicilia') selected @endif @endisset>Sicilia</option>
                                <option value="Toscana" @isset($filtri) @if($filtri['regione']=='Toscana') selected @endif @endisset>Toscana</option>
                                <option value="Trentino-Alto Adige" @isset($filtri) @if($filtri['regione']=='Trentino-Alto Adige') selected @endif @endisset>Trentino-Alto Adige</option>
                                <option value="Umbria" @isset($filtri) @if($filtri['regione']=='Umbria') selected @endif @endisset>Umbria</option>
                                <option value="Val d'Aosta" @isset($filtri) @if($filtri['regione']=="Val d'Aosta") selected @endif @endisset>Val d'Aosta</option>
                                <option value="Veneto" @isset($filtri) @if($filtri['regione']=='Veneto') selected @endif @endisset>Veneto</option>
                            </select>
                        </fieldset>
                        <fieldset>
                            <legend>Società organizzatrice</legend>
                            <select class="select-input" name="org">
                                <option value="">Seleziona organizzatore</option>
                                @foreach($organizzatori as $org)
                                    <option value="{{ $org->nome_org }}" @isset($filtri) @if($filtri['org']==$org->nome_org) selected @endif @endisset>{{ $org->nome_org }}</option>
                                @endforeach
                            </select>
                        </fieldset>
                        <br>
                        <fieldset>
                            <button class="form_btn" type="submit">Applica</button>
                            <button id="azzera" class="form_btn" type="button">Azzera</button>
                        </fieldset>

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script>
                            $(function () {
                                $('#azzera').
                                    on('click', function() {
                                        $('input[name="descrizione"]').val('');
                                        $('select[name="mese"] option[value=""]').prop('selected', true);
                                        $('select[name="anno"] option[value=""]').prop('selected', true);
                                        $('select[name="regione"] option[value=""]').prop('selected', true);
                                        $('select[name="org"] option[value=""]').prop('selected', true);
                                })
                            })
                        </script>
                    </form>
                </div>
            </aside>
        </div>
        <!-- CHIUDE DIV CATALOG (FILTRI)-->
    </div>
    <!-- CHIUDE SEZIONE FILTRI E CATALOGO (container2)-->
@endsection
