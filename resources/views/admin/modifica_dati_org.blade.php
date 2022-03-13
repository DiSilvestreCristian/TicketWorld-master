@extends('layouts.struttura')

@section('title', 'Modifica dati')

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">Admin</a></li>
    <li><a href="{{ route('showOrg') }}">Gestione organizzatori</a></li>
    <li><a href="{{ route('modifyDataOrg', [$dati_org->id]) }}">Modifica dati</a></li>
@endsection

@section('content')
    <div id="container2">
           <div class="form_dati">
             <h3>Modifica dati organizzatore</h3>
               <form class="form_style" action="{{route('modifyDataOrg', [$dati_org->id])}}" method="post">
                   @csrf
                   <fieldset>
                       <label for="email"><h6>E-Mail</h6></label>
                       <input type="email" id="email" name="email" class="search-input" value="{{$dati_org->email}}" required>
                       <br><br>
                       <label for="piva"><h6>Partita iva</h6></label>
                       <input type="number" id="piva" name="piva" class="search-input" value="{{$dati_org->piva}}" required>
                   </fieldset>
                   <input type="submit" class="form_btn" value="Modifica">
               </form>
           </div>
    </div>
@endsection
