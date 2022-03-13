@extends('layouts.struttura')

@section('title', 'Gestione organizzatori')

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">Admin</a></li>
    <li><a href="{{ route('showOrg') }}">Gestione organizzatori</a></li>
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
    <div id="contenuto_catalogo">
        <div class="header_org">
            @if($org->total() != 1)
            <h3>Lista organizzatori ({{$org->total()}} risultati)</h3>
            @else
            <h3>Lista organizzatori (1 risultato)</h3>
            @endif
            <div class="bottone_admin">
                <div class="bottone_evento">
                    <a href="{{route ('addOrg')}}"><button type="button" name="button" class="lgn_btn">Aggiungi nuovo organizzatore</button></a>
                </div>
            </div>
        </div>

        <ul>
            @foreach ($org as $organizzatore)
            <li id="elemento_lista">
                <div class="nome_organizz">
                    <h5>{{ $organizzatore->nome_org}}</h5>
                </div>
                <div class="options">
                    <h5>
                        <a style="color: #225bda" href="{{route ('statOrg',[$organizzatore->nome_org]) }}">Statistiche</a>
                        <a style="color: #225bda" href="{{route ('modifyOrg',[$organizzatore->id]) }}">Modifica</a>
                        <a href="{{route ('deleteOrg',[$organizzatore->id]) }}" onclick="return confirm('Sei sicuro di voler eliminare l\'organizzatore selezionato?')">Elimina</a>
                    </h5>
                </div>
            </li>
            @endforeach
        </ul>
        @include ('pagination.paginator',['paginator' => $org])
    </div>
    <div class="catalog">
        <aside id="sidebar">
            <br>
            <div style="margin-left: 20px">
                <h3>Gestione</h3>
                <div class="menu_admin">
                    <div class="menu">
                        <ul>
                            <li><a href="{{ route ('showUser') }}"><h6>Gestione utenti</h6></a></li>
                            <li><a href="{{ route ('showOrg') }}"><h6>Gestione organizzatori</h6></a></li>
                            <li><a href="{{ route ('showFaqAdmin') }}"><h6>Modifica FAQ</h6></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
            <h3 style="margin-left: 20px">Gestione organizzatori</h3>
            <div class="menu" style="margin-left: 20px">
                <ul>
                    <form class="" action="{{route('processFilterOrgName')}}" method="post">
                        @csrf
                        <fieldset>
                            <legend>Nome Organizzatore</legend>
                            <input type="text"  name="orgname" class="search-input" @isset($filtro) value="{{$filtro}}" @endisset placeholder="Nome">
                        </fieldset>
                        <fieldset>
                            <button type="submit" name="button" class="form_btn">Ricerca </button>
                        </fieldset>
                    </form>
                </ul>
            </div>
        </aside>
    </div>
    </div>
@endsection
