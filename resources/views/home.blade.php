@extends('layouts.struttura')

@section('title', 'Home')


@section('navbar')
@include('layouts._nav')
@endsection

@section('image')
    <figure><img src="images/home_concert.jpeg" alt="immagine" class="img"></figure>@endsection

@section('breadcrumb')

@section('content')

    <div class="home2">
        <div>
            <div class="home_circles">
                <h4>Ultimi aggiunti</h4>
                <br>
                <!-- CODICE -->
                @foreach($newer as $concerto)
                    <a href="{{ route('eventDetails', [$concerto->event_id]) }}"><img src="{{ asset('images/' . $concerto->image_catalogo) }}" class="round_home"></a>
                @endforeach
            </div>
            <div class="home_circles">
                <h4>Più venduti</h4>
                <br>
								<!-- CODICE -->
                @foreach($requested as $concerto)
                    <a href="{{ route('eventDetails', [$concerto->event_id]) }}"><img src="{{ asset('images/' . $concerto->image_catalogo) }}" class="round_home"></a>
                @endforeach

            </div>
        </div>

    </div>
    <!--chiude il div class="container" -->
@endsection
