<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
        <title>TicketWorld • @yield('title')</title>
    </head>
    <body>
    	<div id="wrapper">
    		<!-- HEADER -->
    		@include('layouts._header')
    		<!-- NAVBAR-->
    		@yield('navbar')

        <!-- Eventuale copertina-->
        @yield('image')

    		<!-- BREADCRUMB -->
    		<ul class="breadcrumb">
                <li><a href="{{ route('home1') }}">Home</a></li>
                @yield('breadcrumb')
    		</ul>
    		@yield('content')
    		<!-- FOOTER -->
    		@include('layouts._footer')
    		<div class="clear"></div>
    	</div>
    	<!--chiude il div class="wrapper" -->
    </body>
</html>
