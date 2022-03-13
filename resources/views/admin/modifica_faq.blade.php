@extends('layouts.struttura')

@section('title', 'Modifica FAQ')

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">Admin</a></li>
    <li><a href="{{ route('showFaqAdmin') }}">FAQ</a></li>
    <li><a href="{{ route('modifyFaq', [$dati_faq->id]) }}">Modifica FAQ</a></li>
@endsection

@section('content')
    <div id="container2">
        <div class="form_dati">
            <h3>Modifica FAQ</h3>
            <form action="{{route('modifyDataFaq', [$dati_faq->id])}}" method="post">
                @csrf
                <fieldset>
                    <label for="domanda"><h6>Domanda</h6></label>
                    <textarea name="domanda" style="width:1126px;height:20px;" required>{{$dati_faq->domanda}}</textarea>
                    <br><br>
                    <label for="risposta"><h6>Risposta</h6></label>
                    <textarea name="risposta" style="width:1126px;height:70px;" required>{{$dati_faq->risposta}}</textarea>
                </fieldset>
                <input type="submit" class="form_btn" value="Modifica">
            </form>
        </div>
    </div>
@endsection
