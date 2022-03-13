@extends('layouts.struttura')

@section('title', 'Area organizzatori')

@section('breadcrumb')
    <li><a href="{{ route('org_area') }}">Area organizzatori</a></li>
@endsection


@section('content')

    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
    </script>

<div id="container2">
    <!-- SEZIONE DI FILTRI E EVENTI -->
  <div class="eventi_organizzati">
    <div id="contenuto_catalogo">
        <div class="header_org">
            @if($eventi->total() != 1)
            <h3>Lista eventi ({{$eventi->total()}} risultati)</h3>
            @else
            <h3>Lista eventi (1 risultato)</h3>
            @endif
            <div class="bottone_admin">
                <div class="bottone_evento" style="margin-right: 10px">
                    <a href="{{route ('nuovoEvento')}}"><button type="button" name="button" class="lgn_btn">Crea nuovo evento</button></a>
                </div>
            </div>
        </div>
      <ul>
          <div style="display: none">{{ $i = 0 }}</div>
        @foreach($eventi as $evento)
        <li id="elemento_lista">
          <div class="riquadro_concerto">
            <div class=""> <img src="{{ asset('images/' . $evento->image_catalogo) }}" alt="" class="immagine_concerto"> </div>
            <div class="testo_concerto">
              <h4>{{$evento->artista}}</h4>
              <br>Data: {{ date("d/m/Y", strtotime($evento->data)) }} - Ora: {{ substr($evento->ora, 0, -3) }}
              <br>Luogo: {{$evento ->regione}} - {{ $evento->luogo }}
                @if($sconti[$i][0] == 0)
                    <br>Prezzo: €{{ bcadd($evento->costo, 0.00, 2) }}
                @else
                    <br>Prezzo: <strike>€{{ bcadd($evento->costo, 0.00, 2) }}</strike> €{{ bcadd($sconti[$i][1], 0.00, 2) }}
                @endif
                <div style="display: none">{{ ++$i }}</div>
              <!-- Titolo, Data, Luogo, Prezzo-->
            </div>
            <div class="options">
                <h6>
                    <a style="color: #225bda" href="{{route('statistiche', [$evento->event_id])}}">Statistiche</a>
                    <a style="color: #225bda" href="{{route('modificaEvento', [$evento->event_id])}}">Modifica</a>
                    <a href="{{route ('cancellaEvento',[$evento->event_id])}}" onclick="return confirm('Sei sicuro di voler eliminare l\'evento selezionato?')">Elimina</a>
                </h6>
            </div>
          </div>
        </li>
        @endforeach
      </ul>
        @include('pagination.paginator', ['paginator' => $eventi])
    </div>
    <!-- CHIUDE LA LISTA EVENTI -->
    <!-- FILTRI -->
    <div class="catalog">
      <aside id="sidebar">
        <div>
          <br>
          <h3 style="margin-left: 20px">Filtra eventi</h3>
          <div class="menu" style="margin-left: 20px">
            <ul>
              <form class="" action="{{ route('processArtistEvents') }}" method="post">
                @csrf
                <fieldset>
                  <legend>Artista evento</legend>
                  <input type="text" name="artista" class="search-input" placeholder="Artista" @isset($descrizione)value="{{$artista}}"@endisset>
                </fieldset>
                <fieldset>
                  <button class="form_btn" type="submit" name="button" >Ricerca </button>
                </fieldset>
              </form>
            </ul>
          </div>
        </div>
      </aside>
    </div>
  </div>
  <!-- CHIUDE SEZIONE FILTRI E EVENTI -->

</div>
@endsection
