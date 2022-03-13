@extends('layouts.struttura')

@section('title', 'Aggiungi organizzatore')

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">Admin</a></li>
    <li><a href="{{ route('showOrg') }}">Gestione organizzatori</a></li>
    <li><a href="{{ route('addOrg') }}">Aggiungi organizzatore</a></li>
@endsection

@section('content')
    <div id="container2">
        <div class="form_dati">
            <h3>Aggiungi organizzatore</h3>
            <form class="form_style" method="POST" action="{{ route('addNewOrg') }}">
                @csrf
                <fieldset>
                    <label for="username"><h6>Username</h6></label>
                    <input type="text" id="username" name="username" class="search-input" value="{{ old('username') }}" required>
                    @error('username')
                    <br>
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <br><br>
                    <label for="password"><h6>Password</h6></label>
                    <input type="password" id="password" name="password" class="search-input" value="{{ old('password') }}" required>
                    @error('password')
                    <br>
                    <span class="invalid-feedback" role="alert">
                        <b>{{ $message }}</b>
                                    </span>
                    @enderror
                    <br><br>
                    <label for="nome_org"><h6>Nome organizzatore</h6></label>
                    <input type="text" id="nome_org" name="nome_org" class="search-input" value="{{ old('nome_org') }}" required>
                    @error('nome_org')
                    <br>
                    <span class="invalid-feedback" role="alert">
                        <b>{{ $message }}</b>
                                    </span>
                    @enderror
                    <br><br>
                    <label for="email"><h6>E-mail</h6></label>
                    <input type="email" id="email" name="email" class="search-input" value="{{ old('email') }}" required>
                    <br><br>
                    <label for="piva"><h6>Partita IVA</h6></label>
                    <input type="number" id="piva" name="piva" class="search-input" value="{{ old('piva') }}" required>
                </fieldset>
                <input type="submit" class="form_btn" value="Crea">
            </form>
        </div>
    </div>
@endsection
