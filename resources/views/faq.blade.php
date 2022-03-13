@extends('layouts.struttura')

@section('title', 'Info & FAQ')

@section('breadcrumb')
<li><a href="{{ route('faq')}}">Info & FAQ</a></li>
@endsection

@section('content')
<!-- CONTENUTO FAQ -->
    <div id="container2">
        <br>
        <div id="info">
          <h3 id="faq">Informazioni utili</h3><br>
          <ul>
            <li id="domanda">
              <div class="testo_domanda">
                <h4>Acquisto di un biglietto</h4>
                <br><h5>TicketWorld è il principale rivenditore online di biglietti
                per concerti ed eventi musicali. Offriamo una ricchissima selezione di
                artisti che si esibiscono nei più grandi e importanti palcoscenici
                d'Italia.<br><br>
                Per acquistare il tuo primo biglietto effettua l'accesso al sito tramite il
                tasto in alto a destra e registrati inserendo username e password. <br>
                Tramite la sezione CATALOGO del sito puoi ricercare l'evento che ti interessa
                per poi conoscerne i dettagli e valutarne l'acquisto. <br> <br>
                Hai a disposizione diversi metodi di pagamento disponibili tra i quai puoi
                scegliere quello che utiizzi di solito. Una volta completato l'acquisto visualizzerai una pagina riepilogativa con i dettagli
                dell'ordine. <br>
                </h5>
              </div>
            </li>
            <li id="domanda" style="margin-bottom: 20px;">
              <div class="testo_domanda">
                <h4>Organizzatori di eventi</h4>
                <br><h5>Se sei responsabile di un'azenda che si occupa di organizzazione
                di eventi musicali e hai bisogno di qualcuno che gestisca la vendita
                dei bigietti allora facciamo al caso tuo.<br><br>
                Puoi inviarci una mail all'indirizzo admin@test.com specificando le informazioni
                della tua organizzazione e ti forniremo le credenziali per l'accesso
                ad un account 'organizzatore' grazie al quale potrai gestire gli eventi futuri. <br>
                </h5>
              </div>
            </li>
          </ul>
      <h3 id="faq">Domande frequenti (FAQ)</h3><br>
            @foreach($faq as $domanda)
      <ul>
        <li id="domanda">
          <div class="testo_domanda">
            <h4>{{ $domanda->domanda }}</h4>
            <br><h5>{{ $domanda->risposta }}</h5>
          </div>
        </li>
      </ul>
            @endforeach
      </div>
    </div>
  @endsection
