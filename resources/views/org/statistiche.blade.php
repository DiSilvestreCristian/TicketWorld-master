@extends('layouts.struttura')

@section('title', 'Statistiche')

@section('breadcrumb')
    <li><a href="{{ route('org_area') }}">Area organizzatori</a></li>
    <li><a href="{{ route('statistiche',$evento->event_id) }}">Statistiche</a></li>
@endsection

@section('content')
    <div id="container2">
            <div class="titolo_scheda">
                <br><h1><b>{{$evento->artista}}</b></h1>
            </div>
            <div style="margin: 20px 20px;">
                <h5><b>BIGLIETTI VENDUTI: </b>{{$statistiche['venduti']}}</h5>
                <h5><b>INCASSO TOTALE: </b>€{{bcadd($statistiche['incasso'],0.00,2)}}</h5>
                <h5><b>PERCENTUALE VENDITE: </b>{{$statistiche['percentuale']}}%</h5>
            </div>
    </div>
@endsection
