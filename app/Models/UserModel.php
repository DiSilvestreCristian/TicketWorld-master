<?php

namespace App\Models;

use App\Models\Resources\Eventi;
use App\Models\Resources\Partecipazione;
use App\Models\Resources\Utente;
use App\Models\Resources\Biglietto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use PhpParser\Node\Expr\Array_;

class UserModel extends Model
{
    public function getPersonalData($id_utente){
        return Utente::where('id', $id_utente)->get();
    }

    public function getBigliettiAcquistati($id_utente){
        $biglietti = DB::table('tickets')
            ->join('events', 'id_evento', '=', 'event_id')
            ->join('users', 'user_id', '=', 'id')
            ->select('tickets.ticket_id', 'tickets.costo_biglietto', 'events.*', 'users.id')
            ->where('users.id', '=', $id_utente)
            ->orderBy('ticket_id', 'DESC')
            ->paginate(10);
        return $biglietti;
    }

    public function setUserData($request){
        $user = Utente::find(Auth::id());
        if (!(Hash::check($request['password_check'], $user->password))) return false;
        $user->name= $request['name'];
        $user->surname= $request['surname'];
        $user->email= $request['email'];
        $user->data_nascita= $request['date'];
        if($request['password'] != '') $user->password= Hash::make($request['password']);
        $user->save();
        return true;
    }

    public function buyTicket($evento, $numero) {

        $user = Utente::find(Auth::id());
        $codici = [];

        $obj = new PublicModel();
        $check = $obj->checkDiscount($evento);

        $concerto = Eventi::where('event_id', $evento)->get();

        if($concerto[0] -> biglietti_rimasti <= 0)
            abort(403, 'Biglietti esauriti per questo concerto');

        $concerto[0]->biglietti_rimasti -= $numero;
        $concerto[0]->save();

        for ($i = 0; $i < $numero; $i++) {
            $biglietto = new Biglietto();
            $biglietto->id_evento = $evento;
            $biglietto->user_id = $user->id;
            if($check[0] != 0) $biglietto->costo_biglietto = $check[1];
            else $biglietto->costo_biglietto = $concerto[0]->costo;
            $biglietto->save();
            $codici[$i] = $biglietto->ticket_id;
        }

        $array = [$codici, $biglietto->costo_biglietto];

        return $array;

    }

    public function addPartecipation($id_evento, $id_utente) {
        $partecipazione = new Partecipazione();
        $partecipazione->id_evento_partecipazione = $id_evento;
        $partecipazione->user_id_partecipazione = $id_utente;
        $partecipazione->save();
    }

    public function removePartecipation($id_evento, $id_utente) {
        $partecipazione = Partecipazione::where('id_evento_partecipazione', $id_evento)
            ->where('user_id_partecipazione', $id_utente);
        $partecipazione->delete();
    }
}
