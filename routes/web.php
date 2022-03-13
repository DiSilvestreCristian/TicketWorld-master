<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rotta per la home
Route::get('/', 'PublicController@showHome') -> name('home1');

// Rotte per il catalogo
Route::get('/catalogo', 'PublicController@showCatalog') -> name('showCatalog');

Route::post('/catalogo', 'PublicController@processFilterForm') -> name('processForm');
Route::get('/catalogo/filtro/{filtro}', 'PublicController@showFilteredCatalog');

// Rotta per faq
Route::get('/faq', 'PublicController@showFAQ') -> name('faq');

// Rotta per contatti
Route::view('/contatti', 'contatti') -> name('contatti');


Route::get('/user', 'LV2Controller@showAreaPersonale') -> name('user_area')->middleware('can:isUser');

Route::get('/user/modificadati', 'LV2Controller@showFormModificaDati') -> name('modificaDati')->middleware('can:isUser');
Route::post('/user/modificadati', 'LV2Controller@modificaDati') -> name('modificaDatiUser')->middleware('can:isUser');

// Rotta area organizzatori
Route::get('/org', 'LV3Controller@showAreaOrganizzatori') -> name('org_area')->middleware('can:isOrg');

// Rotta crea evento
Route::view('/org/creaevento', 'org.nuovo_evento') -> name('nuovoEvento')->middleware('can:isOrg');
Route::post('/org/creaevento', 'LV3Controller@creaEvento') -> name('creaEvento')->middleware('can:isOrg');

// Rotta filtro per artista
Route::post('/org', 'LV3Controller@processArtistEvents') -> name('processArtistEvents');
Route::get('/org/{artista}','LV3Controller@showFilteredEvents') -> name('filteredEvents');

// Rotta per statistiche per evento
Route::get('/org/statistiche/{id_evento}', 'LV3Controller@showStatistiche') -> name('statistiche')->middleware('can:isOrg');

//Rotta per cancellare eventi
Route::get('/org/cancellaevento/{id}', 'LV3Controller@cancellaEvento') -> name('cancellaEvento')->middleware('can:isOrg');

//Rotte per modifica eventi
Route::get('/org/modificaevento/{id_evento}', 'LV3Controller@showFormModificaEvento') -> name('modificaEvento')->middleware('can:isOrg');
Route::post('/org/modificaevento', 'LV3Controller@modificaEvento') -> name('modEvento')->middleware('can:isOrg');

// Rotta per scheda evento
Route::get('/evento/{id_evento}', 'PublicController@eventDetails') -> name('eventDetails');

// Rotta per l'acquisto
Route::get('/acquista/{id_evento}', 'LV2Controller@showPayment') -> name('showPayment') -> middleware('can:isUser');

// Rotta per riepilogo (con effettiva interazione DB per biglietto)
Route::post('/acquisto', 'LV2Controller@buy') -> name('buy') -> middleware('can:isUser');

Route::get('/riepilogo/{dati}', 'LV2Controller@summary') -> middleware('can:isUser');

// Rotta per il parteciperò
Route::get('/partecipa/{id_evento}/{azione}', 'LV2Controller@partecipa') -> name('partecipa') -> middleware('can:isUser');

// Rotte per l'autenticazione
Route::get('login', 'Auth\LoginController@showLoginForm')
    ->name('login');

Route::post('login', 'Auth\LoginController@login');

Route::post('logout', 'Auth\LoginController@logout')
    ->name('logout');

// Rotte per la registrazione
Route::get('register', 'Auth\RegisterController@showRegistrationForm')
    ->name('register');

Route::post('register', 'Auth\RegisterController@register');

// Rotta per home lv.4
Route::view('/admin', 'admin.admin') -> name('admin') -> middleware('can:isAdmin');

Route::get('/admin/utenti', 'LV4Controller@showUser') -> name('showUser') -> middleware('can:isAdmin');

Route::get('/admin/utenti/elimina/{id}', 'LV4Controller@deleteUser') -> name('deleteUser') -> middleware('can:isAdmin');

Route::get('/admin/org', 'LV4Controller@showOrg') -> name('showOrg') -> middleware('can:isAdmin');

Route::get('/admin/org/elimina/{id}', 'LV4Controller@deleteOrg') -> name('deleteOrg') -> middleware('can:isAdmin');

Route::get('/admin/org/statistiche/{nome_org}', 'LV4Controller@statOrg') -> name('statOrg') -> middleware('can:isAdmin');

Route::get('/admin/org/modificadati/{id}', 'LV4Controller@showFormModifyOrg') -> name('modifyOrg') -> middleware('can:isAdmin');
Route::post('/admin/org/modificadati/{id}', 'LV4Controller@modifyDataOrg') -> name('modifyDataOrg') -> middleware('can:isAdmin');

Route::view('/admin/org/aggiungi', 'admin.aggiungi_org') -> name('addOrg') -> middleware('can:isAdmin');
Route::post('/admin/org/aggiungi', 'LV4Controller@addNewOrg') -> name('addNewOrg') -> middleware('can:isAdmin');

Route::get('/admin/faq', 'LV4Controller@showFaqAdmin') -> name('showFaqAdmin') -> middleware('can:isAdmin');

Route::view('/admin/faq/aggiungi', 'admin.aggiungi_faq') -> name('addFaq') -> middleware('can:isAdmin');
Route::post('/admin/faq/aggiungi', 'LV4Controller@addNewFaq') -> name('addNewFaq') -> middleware('can:isAdmin');

Route::get('/admin/faq/modifica/{id}', 'LV4Controller@showFaqModify') -> name('modifyFaq') -> middleware('can:isAdmin');
Route::post('/admin/faq/modifica/{id}', 'LV4Controller@modifyDataFaq') -> name('modifyDataFaq') -> middleware('can:isAdmin');

Route::get('/admin/faq/elimina/{id}', 'LV4Controller@deleteFaq') -> name('deleteFaq') -> middleware('can:isAdmin');

Route::post('/admin/utenti', 'LV4Controller@processFilterUsername') -> name('processFilterUsername') -> middleware('can:isAdmin');
Route::get('/admin/utenti/{filtro}', 'LV4Controller@searchByUsername') -> name('searchByUsername') -> middleware('can:isAdmin');

Route::post('/admin/org', 'LV4Controller@processFilterOrgName') -> name('processFilterOrgName') -> middleware('can:isAdmin');
Route::get('/admin/org/{filtro}', 'LV4Controller@searchByOrgName') -> name('searchByOrgName') -> middleware('can:isAdmin');

Route::get('/admin/seeding', 'LV4Controller@seeding') -> name('seeding') -> middleware('can:isAdmin');
