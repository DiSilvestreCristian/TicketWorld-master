<?php

namespace App\Http\Controllers;

use App\Models\PublicModel;
use App\Models\Resources\Utente;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;


class LV2Controller extends Controller
{

    protected $_UserModel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->_UserModel = new UserModel;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showAreaPersonale()
    {
        $dati_personali = $this->_UserModel->getPersonalData(Auth::id());
        $biglietti_acquistati = $this->_UserModel->getBigliettiAcquistati(Auth::id());
        return view('user.area_personale')
            ->with('dato', $dati_personali[0])
            ->with('biglietti', $biglietti_acquistati);
    }

    public function showFormModificaDati(){
        $dati_personali = $this->_UserModel->getPersonalData(Auth::id());
        return view('user.form_modifica')
            ->with('info', $dati_personali[0]);
    }

    public function modificaDati(){
        if($_POST['password'] != $_POST['password_confirm']) return redirect()->back()->with('alert', 'Le password non corrispondono.');
        $ok = $this->_UserModel->setUserData($_POST);
        if (!$ok) return redirect()->back()->with('alert', 'Modifiche non avvenute. Password precedente sbagliata.');
        else return redirect()->route('user_area');
    }

    public function showPayment($id_evento) {

        $_PublicModel = new PublicModel();
        $evento = $_PublicModel->getEventDetails($id_evento);

        if($evento[0]->data <= date("Y-m-d")) abort(403, "Non puoi più acquistare biglietti per questo evento");
        if($evento[0]->biglietti_rimasti <=0) abort(403, "Biglietti esauriti per questo concerto");

        $sconto = $_PublicModel->checkDiscount($id_evento);

        return view('purchase.acquisto')
            -> with('evento', $evento[0])
            ->with('sconti', $sconto);

    }

    public function buy() {

        $_PublicModel = new PublicModel();
        $evento = $_PublicModel->getEventDetails($_POST['id_evento']);

        $metodo = $_POST['metodo_pagamento'];
        $num = $_POST['num_biglietti'];
        $codici = $this->_UserModel->buyTicket($_POST['id_evento'], $_POST['num_biglietti']);

        $user = Utente::find(Auth::id());

        $riepilogo = ['id_evento' => $evento[0]->event_id, 'metodo' => $metodo, 'numero' => $num, 'codici' =>$codici, 'user' => $user->id];
        $dati = base64_encode(serialize($riepilogo));

        return redirect('/riepilogo/'.$dati);

    }

    public function summary($dati) {

        $riepilogo = unserialize(base64_decode($dati));

        $user = Utente::find(Auth::id());
        if($user->id != $riepilogo['user']) abort(403, "Non puoi accedere a queste informazioni");

        $_PublicModel = new PublicModel();
        $evento = $_PublicModel->getEventDetails($riepilogo['id_evento']);

        return view('purchase.riepilogo')
            -> with('evento', $evento[0])
            -> with('metodo_pagamento', $riepilogo['metodo'])
            -> with('num_biglietti', $riepilogo['numero'])
            -> with('codici', $riepilogo['codici'][0])
            -> with('prezzo', $riepilogo['codici'][1]);

    }

    public function partecipa ($id_evento, $action) {

        switch($action) {
            case 0 : $this->_UserModel->removePartecipation($id_evento, Auth::id());
            break;
            case 1 : $this->_UserModel->addPartecipation($id_evento, Auth::id());
            break;
            default : break;
        }
        return redirect()->route('eventDetails', $id_evento);
    }


}
