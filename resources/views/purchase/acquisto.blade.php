@extends('layouts.struttura')

@section('title', 'Acquisto')

@section('breadcrumb')
    <li><a href="{{ route('showCatalog') }}">Catalogo</a></li>
    <li><a href="{{ route('eventDetails', [$evento->event_id]) }}">Evento</a></li>
    <li><a href="{{ route('showPayment', [$evento->event_id]) }}">Acquisto</a></li>
@endsection

@section('content')

    <div id="container2">
        <div class="titolo_scheda">

            <div style="display: none">
                @if($sconti[0] == 0) {{ $prezzo_biglietto = $evento->costo }}
                @else {{ $prezzo_biglietto = $sconti[1] }}
                @endif
            </div>

            <br><h1><b>{{ $evento->artista }}</b> -
                @if($sconti[0] == 0)
                    <b style="color: #eb8215;">Prezzo: €{{ bcadd($prezzo_biglietto, 0.00, 2) }}</b></h1>
                @else
                <b style="color: #eb8215;">Prezzo: <strike style="color: darkred">€{{ bcadd($evento->costo, 0.00, 2) }}</strike> €{{ bcadd($prezzo_biglietto, 0.00, 2) }}</b></h1>
                @endif
        </div>
        <div class="acquisto">
            <form id="buy_form" name="buy_form" class="" action="{{ route('buy') }}" method="post">
                @csrf
                <fieldset>
                    <legend>
                        <h5>
                            <b>Numero biglietti:</b>
                            @if($evento->biglietti_rimasti > 10) (massimo 10 biglietti)
                            @else() (massimo {{ $evento->biglietti_rimasti }} biglietti)
                            @endif
                        </h5>
                    </legend>
                    <input id="numBigl" name="num_biglietti" onchange="calcolaPrezzo()" class="search-input" type="number" value="1" min="1"
                           @if($evento->biglietti_rimasti > 10) max="10"
                           @else max="{{ $evento->biglietti_rimasti }}"
                           @endif style="width: 45px;">
                </fieldset>
                <fieldset>
                    <legend><h5><b>Selezionare il metodo di pagamento:</b></h5></legend>
                    <select class="select-input" name="metodo_pagamento">
                        <option value="Contrassegno">Contrassegno</option>
                        <option value="Carta di credito">Carta di Credito</option>
                        <option value="PayPal">PayPal</option>
                        <option value="PagoPa">PagoPa</option>
                    </select>
                </fieldset>
                <fieldset style="display: none;">
                    <select name="id_evento">
                        <option value="{{ $evento->event_id }}"></option>
                    </select>
                </fieldset>

                <div>
                    <h5><b id="prezzo">Prezzo totale: €{{ bcadd($prezzo_biglietto, 0.00, 2) }}</b></h5>
                    <br>
                </div>

                <fieldset>
                    <button onclick="resetPrice()" class="form_btn" type="reset">Azzera</button>
                    <button class="form_btn" type="submit" onclick="return confirm('Procedere con l\'acquisto?')">Acquista</button>
                </fieldset>
            </form>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                function calcolaPrezzo() {
                    var num = $('#numBigl').val();
                    var prezzo = $('#prezzo');
                    var prezzoTotale = {{ $prezzo_biglietto }} * num;
                    @if($evento->biglietti_rimasti > 10) var max = 10;
                    @else var max = {{ $evento->biglietti_rimasti }};
                    @endif
                    if(prezzoTotale > 0 && num <= max) {
                        prezzo.text('Prezzo totale: '.concat("€").concat(prezzoTotale.toFixed(2)));
                    } else prezzo.text('Troppi biglietti selezionati');
                }

                function resetPrice() {
                    var prezzo = document.getElementById("prezzo");
                    prezzo.innerHTML = 'Prezzo totale: €{{ bcadd($prezzo_biglietto, 0.00, 2) }}';
                }
            </script>

        </div>
    </div>
@endsection
