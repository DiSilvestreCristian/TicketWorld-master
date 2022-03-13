@extends('layouts.struttura')

@section('title', 'Contatti')

@section('breadcrumb')
<li><a href="{{ route('contatti')}}">Contatti</a></li>
@endsection

@section('content')
<div id="container">
			<div class="presentazione">
				<br>
				<h3>Chi siamo?</h3>
				<h6>Siamo Davide, Cristian, Marco e Giordano, 4 studenti di Ingegneria Informatica e dell'Automazione
					presso
					l'Università Politecnica delle Marche. Abbiamo intrapreso un progetto intracorso che ci ha portato
					alla realizzazione di
					un sito per la gestione di eventi (nel nostro caso di concerti).
				</h6>
				<br>
				<h3>Informazioni sulla facoltà:</h3>
				<h5>
					<b>Sede:</b> via Brecce Bianche - Monte Dago - 60131 Ancona<br>
					<br>
					<b>Tel.:</b> +39 0712204708<br>
					<br>
					<b>Telefax:</b> +39 0712204708<br>
					<br>
					<b>e-mail:</b> <a href="mailto:presidenza.ingegneria@univpm.it">presidenza.ingegneria@univpm.it</a>
				</h5>
			</div>
			<div class="mappa">
				<iframe width="400" height="400"
					src="https://maps.google.com/maps?q=universita%20politecnica%20delle%20amrche%20ingegneria&t=k&z=17&ie=UTF8&iwloc=&output=embed"
					frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
			</div>
		</div>
  @endsection
