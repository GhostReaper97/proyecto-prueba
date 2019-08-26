<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integrante extends Model
{
    
    protected $table = "integrante";

    protected $fillable = [
        'nombres',
        'apellidos',
        'email'
    ];

    public function Proyecto(){

        return $this -> belongsToMany(Proyecto::class,'integrante_proyecto','id_integrante','id_proyecto')
            -> withTimestamps();

    }

}
