<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Biglietto extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'ticket_id';
    public $timestamps = false;


// Realazione One-To-One con Utente
    public function ticketEvent(){
        return $this->hasOne(Category::class, 'event_id', 'id_evento');
    }

    public function ticketUser(){
        return $this->hasOne(Category::class, 'id', 'user_id');
    }
}
