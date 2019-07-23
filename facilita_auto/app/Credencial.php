<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credencial extends Model
{
    protected $table = 'credencial';

    protected $fillable = [
        "nome",
        "ClientID",
        "ClientSecret",
        "UrlAutenticacao",
        "Endpoint"
    ];
}
