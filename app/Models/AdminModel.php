<?php

namespace App\Models;

use App\Models\Resources\Eventi;
use App\Models\Resources\Utente;
use App\Models\Resources\Biglietto;
use App\Models\Resources\FAQ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use PhpParser\Node\Expr\Array_;

class AdminModel extends Model
{
    public function getUsers(){
        return Utente::where('livello_utenza', 2) -> orderBy('username') -> paginate(9);
    }

    public function deleteUserDB ($id){

            $utente = Utente::find($id);
            $utente->delete();

    }

    public function getOrg(){
        return Utente::where('livello_utenza', 3) -> orderBy('nome_org') -> paginate(9);
    }

    public function deleteOrgDB ($id){

        $utente = Utente::find($id);
        $nome_org = Utente::where('id', $id)->get();
        $eventi = Eventi::where('org_name', $nome_org[0]->nome_org)->get();
        $obj = new OrgModel();
        foreach ($eventi as $evento) {
            $obj->cancellaEventoDB($evento->event_id);
        }
        $utente->delete();
    }

    public function numBiglietti ($nome_org){
        $biglietto = Biglietto::join('events','id_evento', 'event_id')
            ->where('org_name', $nome_org)
            ->get();
        $num = count($biglietto);
        return($num);
    }

    public function guadagnoTot ($nome_org){

        $join = Eventi::where('org_name', $nome_org)
            ->join('tickets', 'event_id', '=', 'id_evento') ->get();
        $tot=0;
        foreach ($join as $elem){
            $tot += $elem->costo_biglietto;
        }
        return($tot);
    }

    public function getOrgData ($id){
        return Utente::where('id', $id)->get();
    }

    public function setOrgData ($request, $id){
        $utenti = Utente::where('id', $id)->get();
        $org = $utenti[0];
        $org->email= $request['email'];
        $org->piva= $request['piva'];
        $org->save();
    }

    public function addOrg ($request) {
        $org = new Utente;
        $org->fill($request->all());
        $org->livello_utenza = '3';
        $org->password = Hash::make($request->password);
        $org->save();
    }

    public function getFaq() {
        return FAQ::all();
    }

    public function addFaq ($post) {
        //dd($request);
        $faq = new FAQ;
        $faq->domanda = $post['domanda'];
        $faq->risposta = $post['risposta'];
        $faq->save();
    }

    public function getFaqData($id) {
        return FAQ::where('id', $id)->get();
    }

    public function setFaqData ($post, $id){
        $allFaq = FAQ::where('id', $id)->get();
        $faq = $allFaq[0];
        $faq->domanda= $post['domanda'];
        $faq->risposta= $post['risposta'];
        $faq->save();
    }

    public function deleteFaqDB($id) {
        $faq = FAQ::find($id);
        $faq->delete();
    }

    public function getUserByUsername($username){
        return Utente::where('livello_utenza', 2)
            -> where('username', 'LIKE', '%'.$username.'%') -> paginate(8);
    }

    public function getOrgByOrgname($orgname){
        return Utente::where('livello_utenza', 3)
            ->where('nome_org', 'LIKE', '%'.$orgname.'%') -> paginate(8);
    }
}
