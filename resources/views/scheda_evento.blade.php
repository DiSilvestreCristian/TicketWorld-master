@extends('layouts.struttura')

@section('title', 'Evento')

@section('breadcrumb')
<li><a href="{{ route('showCatalog') }}">Catalogo</a></li>
<li><a href="{{ route('eventDetails', [$evento->event_id]) }}">Evento</a></li>
@endsection

@section('content')

<!-- INFO -->
<div id="container">
    <div class="titolo_scheda">
        <br><h1 style="padding-left: 0px"><b>{{ $evento->artista }}</b></h1>
    </div>
    <div class="info_acquista">
        <div class="info_evento">
            <h5 style="width: 300px">
                <b>Data:</b> {{ date("d/m/Y", strtotime($evento->data)) }}
                <br><b>Orario:</b> {{ substr($evento->ora, 0, -3) }}
                <br><b>Luogo:</b> {{ $evento->luogo }}
            </h5>
            <br>
            @if($sconti[0] == 0)
                <br><h6><b>Prezzo:</b> €{{ bcadd($evento->costo, 0.00, 2) }}</h6>
            @else
                <br><h6><b>Prezzo:</b> <strike style="color: darkred">€{{ bcadd($evento->costo, 0.00, 2) }}</strike> €{{ bcadd($sconti[1], 0.00, 2) }}</h6>
            @endif
        </div>
        <div class="biglietti">
            <h5>BIGLIETTI RIMASTI <br> <b>{{ $evento->biglietti_rimasti }}</b> </h5>
        </div>

        @guest
            @if($evento->biglietti_rimasti <= 0)
                <div class="bottone_evento">
                    <button class="lgn_btn" style="background-color: red" >Biglietti esauriti</button>
                </div>
            @else
        <div class="bottone_evento">
            <button type="button" name="button" class="lgn_btn" onclick="window.location='{{route('login')}}'">Acquista il biglietto</button>
        </div>
                @endif
        @endguest
        @can('isUser')
            @if($evento->biglietti_rimasti <= 0)
                <div class="bottone_evento">
                    <button class="lgn_btn" style="background-color: red" >Biglietti esauriti</button>
                </div>
            @else
            <div class="bottone_evento">
                <a href="{{ route('showPayment', [$evento->event_id]) }}"><button type="button" name="button" class="lgn_btn">Acquista il biglietto</button></a>
            </div>
            @endif
        @endcan

        @can('isOrg')
            <div class="bottone_evento">
                <button class="lgn_btn" style="background-color: red" >Effettua l'accesso come cliente per acquistare</button>
            </div>
        @endcan


    </div>
    <br>
    <div class="presentazione">
        @guest
        <div class="partecipanti">
            <div class="btn_partecipa">
                <button type="button" name="button" class="lgn_btn" onclick="window.location='{{route('login')}}'">Parteciperò</button>
            </div>
            @if($partecipanti==0)<h5>Nessuno ha intenzione di partecipare</h5>
            @elseif($partecipanti==1)<h5><b>1</b> persona ha intenzione di partecipare</h5>
            @else<h5><b>{{ $partecipanti }}</b> persone hanno intenzione di partecipare</h5>
            @endif
        </div>
        @endguest
        @can('isUser')
                <div class="partecipanti">
                    @if(!$partecipo)
                        <div class="btn_partecipa">
                            <button type="button" name="button" class="lgn_btn" onclick="window.location='{{route('partecipa', [$evento->event_id, 1])}}'">Parteciperò</button>
                        </div>
                    @else
                        <div class="btn_non_partecipa">
                            <button type="button" name="button" class="lgn_btn" onclick="window.location='{{route('partecipa', [$evento->event_id, 0])}}'">Non parteciperò</button>
                        </div>
                    @endif
                    @if($partecipanti==0)<h5>Nessuno ha intenzione di partecipare</h5>
                    @elseif($partecipanti==1)<h5><b>1</b> persona vuole partecipare</h5>
                    @else<h5><b>{{ $partecipanti }}</b> persone vogliono partecipare</h5>
                    @endif
                </div>
        @endcan
                <div class="descrizione_evento">
            <h3>Descrizione evento</h3>
            <h6>{{ $evento->descrizione }}</h6>
            <ul>
                <li><h4>Programma concerto:</h4></li>
                <h6>{{ $evento->programma }}</h6>
                <li><h4>Come arrivare al luogo del concerto:</h4></li>
                <div class="lista_evento">
                    <h6>{{ $evento->indicazioni }}</h6>
                </div>
            </ul>
        </div>
    </div>

    <div class="mappa_evento">
        <iframe width="500" height="500" src="{{ $link_mappa }}"> </iframe>
    </div>
</div>
@endsection
