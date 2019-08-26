<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    
    protected $table = "proyecto";

    protected $fillable = [
        'nombre',
        'descripcion',
        'calificacion'
    ];

    public function Integrante(){

        return $this -> belongsToMany(Integrante::class,'integrante_proyecto','id_proyecto','id_integrante')
            -> withTimestamps();

    }

}
