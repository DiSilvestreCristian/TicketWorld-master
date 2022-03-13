@extends('layouts.struttura')

@section('title', 'Gestione utenti')

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">Admin</a></li>
    <li><a href="{{ route('showUser') }}">Gestione utenti</a></li>
@endsection

@section('content')
    <div id="container2">
        <!-- elenco utenti -->
        <div id="contenuto_catalogo">
            <div class="header_org">
                @if($utenti->total() != 1)
                    <h3>Lista utenti ({{$utenti->total()}} risultati)</h3>
                @else
                    <h3>Lista utenti (1 risultato)</h3>
                @endif
            </div>
            <br><br><br>
            <ul>
               @foreach ($utenti as $utente)
                <li id="elemento_lista">
                    <div class="nome_organizz">
                        <h5>{{ $utente->username}}</h5>
                    </div>
                    <div class="options">
                            <a href="{{route ('deleteUser',[$utente->id]) }}" onclick="return confirm('Sei sicuro di voler eliminare l\'utente selezionato?')"><h5>Elimina</h5></a>
                    </div>
                </li>
                @endforeach
            </ul>
            @include ('pagination.paginator',['paginator' => $utenti])
        </div>
        <!-- chiude elenco utenti -->
        <!-- FILTRI -->
        <div class="catalog">
            <aside id="sidebar">
                <div>
                    <div style="margin-left: 20px">
                        <br>
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
                    <h3 style="margin-left: 20px">Gestione utenti</h3>
                    <div class="menu" style="margin-left: 20px">
                        <ul>
                            <form class="" action="{{route('processFilterUsername')}}" method="post">
                                @csrf
                                <fieldset>
                                    <legend>Username</legend>
                                    <input type="text"  name="username" class="search-input" @isset($filtro) value="{{$filtro}}" @endisset placeholder="Username">
                                </fieldset>
                                <fieldset>
                                    <button type="submit" name="button" class="form_btn">Ricerca</button>
                                </fieldset>
                            </form>
                        </ul>
                    </div>

                </div>
            </aside>
        </div>
        <!-- CHIUDE DIV CATALOG (FILTRI)-->
    </div>
@endsection
