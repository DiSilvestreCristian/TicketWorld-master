<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Utente extends Model
{

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['username', 'password', 'nome_org', 'livello_utenza', 'piva', 'email'];
    public $timestamps = false;
}
