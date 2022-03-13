@extends('layouts.struttura')

@section('title', 'Area personale')

@section('breadcrumb')
    <li><a href="{{ route('user_area') }}">Area personale</a></li>
@endsection


@section('content')
    <div id="container2">
        <div class="dati_personali">
            <h3>Dati personali:</h3>
            <div class="btn_dati">
                <button class="lgn_btn" type="button" name="button" onclick="window.location='{{route('modificaDati')}}'">Modifica dati</button>
            </div>
            <h5>
                <b>Username:</b> {{$dato->username}}<br>
                <b>e-mail:</b> {{$dato->email}}<br><br>
                <b>Nome:</b> {{$dato->name}}<br>
                <b>Cognome:</b> {{$dato->surname}}<br>
                <b>Data di nascita:</b> {{ date("d/m/Y", strtotime($dato->data_nascita)) }}<br><br>
            </h5>
        </div>
        <div class="storico_biglietti">
            @if($biglietti->total() != 1)
            <h3>Storico biglietti ({{ $biglietti->total() }} biglietti acquistati)</h3>
            @else
            <h3>Storico biglietti (1 biglietto acquistato)</h3>
            @endif
            <div class="btn_dati">
                    <button type="button" name="button" class="lgn_btn" onclick="window.location='{{route('showCatalog')}}'">Acquista un nuovo biglietto</button>
            </div>
            <ul>
                @foreach($biglietti as $biglietto)
                <li id="elemento_lista">
                    <div class="riquadro_concerto">
                        <div class=""> <img src="{{ asset('images/' . $biglietto->image_catalogo) }}" alt="" class="immagine_concerto"> </div>
                        <div class="testo_concerto">
                            <h3><b>{{$biglietto->artista}}</b></h3>
                            <br> <b>Data:</b> {{date("d/m/Y", strtotime($biglietto->data)) }}
                            <br> <b>Luogo:</b> {{$biglietto->regione}} - {{$biglietto->luogo}}
                        </div>
                        <div class="prezzo">
                            <h5>PREZZO<br><b>€{{bcadd($biglietto->costo_biglietto, 0.00, 2) }}</b></h5>
                        </div>
                        <div class="codice_biglietto">
                            <h5>CODICE UNIVOCO<br><b>{{$biglietto->ticket_id}}</b></h5>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>

            <!--Paginazione-->
            @include('pagination.paginator', ['paginator' => $biglietti])

        </div>
    </div>
@endsection
