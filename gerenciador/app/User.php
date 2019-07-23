<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image', 'franquia_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function papeis(){
        return $this->belongsToMany(Papel::class);
    }

    public function downloads(){
        return $this->belongsToMany(Download::class);
    }

    public function adicionaDownloads($download){
            return $this->downloads()->save(
                Download::find($download)
            );
    }

        

    public function adicionaPapel($papel){
        if(is_string($papel)){
            return $this->papeis()->save(
                Papel::where('nome', '=', $papel)->firstOrFail()
            );
        }

        $this->papeis()->save(
            Papel::where('nome', '=', $papel->nome)->firstOrFail()
        );

    }

    public function excluirPapel($papel){
        if(is_string($papel)){
            return $this->papeis()->detach(
                Papel::where('nome', '=', $papel)->firstOrFail()
            );
        }

        $this->papeis()->detach(
            Papel::where('nome', '=', $papel->nome)->firstOrFail()
        );

    }

    public function existePapel($papel){
        if(is_string($papel)){
            return $this->papeis->contains('nome',$papel);
        }

        return $papel->intersect($this->papeis)->count();
    }

    public function existeAdmin(){
        return $this->existePapel('admin');
    }
}
