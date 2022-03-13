@extends('layouts.struttura')

@section('title', 'FAQ')

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">Admin</a></li>
    <li><a href="{{ route('showFaqAdmin') }}">FAQ</a></li>
@endsection

@section('content')

    <div id="container2" style=" height: 500px">
        <div class="catalog" style="height: 500px">
            <aside id="sidebar">
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
            </aside>
        </div>
      <div class="page" style="height: 500px; overflow: scroll">
            <div class="header_org">
                <h3>Lista FAQ</h3>
                <div class="bottone_admin">
                    <div class="bottone_evento">
                        <a href="{{route ('addFaq')}}"><button type="button" name="button" class="lgn_btn">Aggiungi nuova FAQ</button></a>
                    </div>
                </div>
            </div>
                <ul>
                    @foreach ($faq as $elem)
                        <li id="elemento_lista">
                            <div class="optionsUp">
                                <h5>
                                    <a style="color: #225bda" href="{{route ('modifyFaq', [$elem->id]) }}">Modifica</a><br>
                                    <a href="{{route ('deleteFaq', [$elem->id])}}" onclick="return confirm('Sei sicuro di voler eliminare l\'elemento selezionato?')">Elimina</a>
                                </h5>
                            </div>
                            <div class="faqAdmin">
                                <h5 style="color: #225bda">{{$elem->domanda}}</h5><br><h5>{{$elem->risposta}}</h5>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

    </div>
@endsection
