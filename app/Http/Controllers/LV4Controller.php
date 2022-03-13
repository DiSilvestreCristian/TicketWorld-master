<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use App\Http\Requests\NewOrgRequest;
use App\Models\PublicModel;
use App\Models\UserModel;
use App\Models\AdminModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;


class LV4Controller extends Controller
{

    protected $_AdminModel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->_AdminModel = new AdminModel;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showUser(){
        $_AdminModel=new AdminModel;

        $utenti = $_AdminModel->getUsers();

        return view ('admin.gestione_utenti')
            ->with ('utenti', $utenti);
    }

    public function deleteUser ($id){
        $_AdminModel=new AdminModel;

        $_AdminModel->deleteUserDB($id);

        return redirect()->route('showUser');
    }

    public function showOrg(){
        $_AdminModel=new AdminModel;

        $org = $_AdminModel->getOrg();

        return view ('admin.gestione_org')
            ->with ('org', $org);
    }

    public function deleteOrg ($id){
        $_AdminModel=new AdminModel;

        $_AdminModel->deleteOrgDB($id);

        return redirect()->route('showOrg');
    }

    public function statOrg($nome_org){
        $_AdminModel=new AdminModel;
        $biglietti = $_AdminModel->numBiglietti($nome_org);
        $guadagno = $_AdminModel->guadagnoTot($nome_org);

        return view ('admin.statistiche_org')
            ->with ('biglietti', $biglietti)
            ->with ('guadagno', $guadagno)
            ->with ('nome', $nome_org);
    }

    public function showFormModifyOrg($id){
        $_AdminModel=new AdminModel;

        $dati_org= $_AdminModel->getOrgData($id);
        return view('admin.modifica_dati_org')
            ->with('dati_org', $dati_org[0]);
    }

    public function modifyDataOrg ($id){

        $this->_AdminModel->setOrgData($_POST, $id);
        return redirect()->route('showOrg')->with('alert', 'Modifiche avvenute con successo');
    }

    public function addNewOrg (NewOrgRequest $request){

        $this->_AdminModel->addOrg($request);
        return redirect()->route('showOrg');
    }

    public function showFaqAdmin () {
        $_AdminModel=new AdminModel;

        $faq= $_AdminModel->getFaq();
        return view('admin.faq_admin')
            ->with('faq', $faq);
    }

    public function addNewFaq () {
        $this->_AdminModel->addFaq($_POST);
        return redirect()->route('showFaqAdmin');
    }

    public function showFaqModify($id){
        $_AdminModel=new AdminModel;

        $dati_faq= $_AdminModel->getFaqData($id);
        return view('admin.modifica_faq')
            ->with('dati_faq', $dati_faq[0]);
    }

    public function modifyDataFaq ($id){

        $this->_AdminModel->setFaqData($_POST, $id);
        return redirect()->route('showFaqAdmin');
    }

    public function deleteFaq ($id){
        $_AdminModel=new AdminModel;

        $_AdminModel->deleteFaqDB($id);

        return redirect()->route('showFaqAdmin');
    }

    public function processFilterUsername () {
        return redirect()->route('searchByUsername',
            [$_POST['username']]);
    }
    public function searchByUsername($username){
        $_AdminModel=new AdminModel;
        $utenti = $_AdminModel->getUserByUsername($username);
        return view ('admin.gestione_utenti')
            ->with ('utenti', $utenti)
            ->with('filtro', $username);
    }

    public function processFilterOrgName () {
        return redirect()->route('searchByOrgName',
            [$_POST['orgname']]);
    }
    public function searchByOrgName($orgname){
        $_AdminModel=new AdminModel;
        $org = $_AdminModel->getOrgByOrgname($orgname);
        return view ('admin.gestione_org')
            ->with ('org', $org)
            ->with('filtro', $orgname);
    }

    public function seeding() {
      Artisan::call('migrate:fresh --seed');
      return redirect()->route('admin');
    }

}
