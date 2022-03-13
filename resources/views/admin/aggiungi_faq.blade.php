@extends('layouts.struttura')

@section('title', 'Aggiungi FAQ')

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">Admin</a></li>
    <li><a href="{{ route('showOrg') }}">FAQ</a></li>
    <li><a href="{{ route('addOrg') }}">Aggiungi FAQ</a></li>
@endsection

@section('content')
    <div id="container2">
        <div class="form_dati">
            <h3>Aggiungi FAQ</h3>
            <form method="POST" action="{{ route('addNewFaq') }}">
                @csrf
                <fieldset>
                    <label for="domanda"><h6>Domanda</h6></label>
                    <textarea name="domanda" style="width:1126px;height:20px;" value="" required></textarea>
                    <br><br>
                    <label for="risposta"><h6>Risposta</h6></label>
                    <textarea name="risposta" style="width:1126px;height:70px;" value="" required></textarea>
                </fieldset>
                <input type="submit" class="form_btn" value="Aggiungi">
            </form>
        </div>
    </div>
@endsection
