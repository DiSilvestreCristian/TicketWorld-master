@extends('layouts.struttura')

@section('title', 'Riepilogo')

@section('breadcrumb')
    <li><a href="{{ route('showCatalog') }}">Catalogo</a></li>
    <li><a href="{{ route('eventDetails', [$evento->event_id]) }}">Evento</a></li>
    <li><a href="{{ route('showPayment', [$evento->event_id]) }}">Acquisto</a></li>
@endsection

@section('content')

    <div id="container2">
        <div class="riepilogo_dati">
            <h3><b>Riepilogo dei dati di acquisto:</b></h3><br>
            <h5>Metodo di pagamento:</h5><br>
            <h6>{{ $metodo_pagamento }}<br></h6>
            <h5>Biglietti acquistati:</h5>
        </div>
        <ul>

            @foreach($codici as $biglietto)
                <li id="elemento_lista" style="margin-left: 20px;" >
                    <div class="riquadro_concerto">
                        <div class="testo_concerto">
                            <h4>{{ $evento->artista }}</h4>
                            <br>Data: {{ date("d/m/Y", strtotime($evento->data)) }}
                            <br>Luogo: {{ $evento->luogo }}
                        </div>
                        <div class="prezzo">
                            <h5>PREZZO<br><b>€{{ bcadd($prezzo, 0.00, 2) }}</b></h5>
                        </div>
                        <div class="codice_biglietto">
                            <h5>CODICE UNIVOCO<br><b>{{ $biglietto }}</b></h5>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="prezzo" style="margin-right: 0px" >
            <h5>TOTALE<br><b>€{{ bcadd($num_biglietti * $prezzo, 0.00, 2) }}</b></h5>
        </div>
        <div class="btn_finali">
            <div class="bottone_acquista">
                    <a href="{{ route('home1') }}"><button name="button" class="lgn_btn">Torna alla home</button></a>
            </div>
            <div class="bottone_acquista">
                <a href="{{ route('showCatalog') }}"><button name="button" class="lgn_btn">Acquista altri biglietti</button></a>
            </div>
        </div>
    </div>

@endsection
