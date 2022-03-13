<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Partecipazione extends Model
{
    protected $table = 'partecipants';
    protected $primaryKey = 'id_partecipazione';
    public $timestamps = false;


// Realazione One-To-One con Utente
    public function partEvent(){
        return $this->hasOne(Category::class, 'event_id', 'id_evento_partecipazione');
    }

    public function partUser(){
        return $this->hasOne(Category::class, 'id', 'user_id_partecipazione');
    }
}
