@extends('layouts.struttura')

@section('title', 'Statistiche organizzatori')

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">Admin</a></li>
    <li><a href="{{ route('showOrg') }}">Gestione organizzatori</a></li>
    <li><a href="{{ route('statOrg', $nome) }}">Statistiche</a></li>
@endsection

@section('content')
    <div id="container2">
            <div class="titolo_scheda">
                <br><h1><b>{{$nome}}</b></h1>
            </div>
            <div style="margin: 20px 20px;">

                <h5><b>BIGLIETTI VENDUTI: </b>{{$biglietti}}</h5>
                <h5><b>GUADAGNO TOTALE: </b>€{{bcadd($guadagno, 0.00, 2)}}</h5>

            </div>
    </div>
@endsection
