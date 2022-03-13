@extends('layouts.struttura')

@section('title', 'Modifica')

@section('breadcrumb')
    <li><a href="{{ route('user_area') }}">Area personale</a></li>
    <li><a href="{{ route('modificaDati') }}">Modifica dati</a></li>
@endsection

@section('content')
    <div id="container2">

        <script>
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
                alert(msg);
            }
        </script>

        <div class="form_dati">
          <h3>Modifica i tuoi dati</h3>
            <form id="mod_dati" action="{{route('modificaDatiUser')}}" method="post">
                @csrf
                <fieldset>
                  <label for="fname"><h6>Nome</h6></label>
                  <input type="text" id="name" name="name" class="search-input" value="{{$info->name}}" required>
                  <br><br>
                  <label for="lname"><h6>Cognome</h6></label>
                  <input type="text" id="surname" name="surname" class="search-input" value="{{$info->surname}}" required>
                  <br><br>
                  <label for="email"><h6>E-Mail</h6></label>
                  <input type="email" id="email" name="email" class="search-input" value="{{$info->email}}" required>
                  <br><br>
                  <label for="date"><h6>Data di nascita</h6></label>
                  <input type="date" id="date" name="date" class="select-input" value="{{$info->data_nascita}}" onkeypress="return false" required>
                  <br><br><br>
                  <label for="password"><h6>Nuova password (opzionale)</h6></label>
                  <input type="password" minlength="8" id="password" name="password" class="search-input" value="">
                  <br><br>
                  <label for="password"><h6>Conferma nuova password (opzionale)</h6></label>
                  <input type="password" minlength="8" id="password_confirm" name="password_confirm" class="search-input" value="">
                  <br><br><br><br>
                  <label for="password"><h6><b>Inserisci la vecchia password per apportare le modifiche</b></h6></label>
                  <input type="password" minlength="8" id="password_check" name="password_check" class="search-input">
                </fieldset>
                <input type="submit" id="bottone_modifica" class="form_btn" value="Modifica">
            </form>

        </div>
    </div>

@endsection
