<?php

namespace App\Models;

use App\Models\Resources\Eventi;
use App\Models\Resources\Partecipazione;
use App\Models\Resources\Utente;
use App\Models\Resources\FAQ;
use DateInterval;
use Illuminate\Support\Facades\DB;

class PublicModel
{
    public function getNewer(){
        //dobbiamo ritornare gli ultimi 4 concerti inseriti
        $eventi = Eventi::all()
            ->sortByDesc('event_id')
            ->where('data', '>=', DATE_SUB(NOW(), new DateInterval("P1D")))
            ->take(6);
        return $eventi;

    }
    public function getRequested(){
        //dobbiamo ritornare i 4 concerti con i biglietti venduti maggiormente
        $eventi = DB::select('select * from events where data >= NOW()-1 order by biglietti_totali-biglietti_rimasti DESC LIMIT 6');
        return $eventi;
    }

    public function getEvents() {
        $eventi = DB::table('events')
            ->where('data', '>', DATE_SUB(NOW(), new DateInterval("P1D")))
            ->orderBy('data')->orderBy('ora')
            ->paginate(5);
        return $eventi;
    }

    public function getOrg() {
        $organizzatori = Utente::where('livello_utenza', 3)->get();
        return $organizzatori;
    }

    public function getFilteredEvents($filtro) {

        $eventi = Eventi::where('event_id', '!=', 'null')
            ->where('data', '>=', NOW())
            ->orderBy('data');

        if($filtro['descrizione'] != "") {
            $eventi = $eventi->where('descrizione', 'LIKE', '%' . $filtro['descrizione'] . '%');
        }

        if($filtro['mese'] != "") {
            $eventi = $eventi->where('data', 'LIKE', '%-' . $filtro['mese'] . '-%');
        }

        if($filtro['anno'] != "") {
            $eventi = $eventi->where('data', 'LIKE', $filtro['anno'] . '-%');
        }

        if($filtro['regione'] != "") {
            $eventi = $eventi->where('regione', $filtro['regione'] );
        }

        if($filtro['org'] != "") {
            $eventi = $eventi->where('org_name', $filtro['org']);
        }

        return $eventi->paginate(5);
    }

    public function getEventDetails($id_evento) {

        $evento = Eventi::where('event_id', $id_evento)->get();

        return $evento;
    }

    public function getPartNum($id_evento) {
        $part = Partecipazione::where('id_evento_partecipazione', $id_evento)->get();
        $num = count($part);
        return $num;
    }

    public function checkPart($id_evento, $id_utente) {
        $partecipa = Partecipazione::where('id_evento_partecipazione', $id_evento)
            ->where('user_id_partecipazione', $id_utente)->get();
        if(count($partecipa)==0) return false;
        else return true;
    }


    public function getFAQ() {

        $faq = FAQ::all();

        return $faq;
    }

    public function checkDiscount($id_evento) {
        $evento = Eventi::find($id_evento);
        if($evento->percentuale_sconto == 0) return [0, $evento->costo];
        $date_diff = (date_diff(date_create(date("Y-m-d")), date_create($evento->data))->days);
        if($date_diff > $evento->giorni_sconto) return [0, $evento->costo];
        $costo = $evento->costo - $evento->costo * $evento->percentuale_sconto / 100;
        return [1, $costo];
    }

}
