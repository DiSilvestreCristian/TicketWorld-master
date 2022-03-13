<?php

namespace App\Models\Resources;

use App\Utente;
use Illuminate\Database\Eloquent\Model;

class Eventi extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'event_id';
    protected $fillable = ['luogo', 'data', 'ora', 'regione', 'image_catalogo', 'image_scheda', 'programma', 'descrizione', 'indicazioni', 'artista', 'biglietti_totali', 'costo', 'percentuale_sconto', 'giorni_sconto' ];
    public $timestamps = false;


// Realazione One-To-One con Utente
    public function eventCreator(){
        return $this->hasOne(Utente::class, 'nome_org', 'org_name');
    }


}
