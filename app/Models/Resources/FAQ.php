<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{

    protected $table = 'faq';
    protected $primaryKey = 'id';
    protected $fillable = [ 'domanda', 'risposta' ];


    public $timestamps = false;
}
