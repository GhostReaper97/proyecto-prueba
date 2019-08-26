<?php

namespace App\Http\Controllers;

use App\Integrante;
use App\Proyecto;
use Illuminate\Http\Request;

class IntegranteController extends Controller
{

    public function index(){

        return view('integrante/integrante');

    }

    public function Listar(){

        $integrate = Integrante::with('proyecto')
            -> get();

        return $integrate;

    }

    public function Buscar($id){

        $integrante = Integrante::find($id);

        return $integrante;

    }

    public function AsignarIntegrante(){

        $json = request() -> input('json');
        $parametrosArray = json_decode($json, true);
        
        $validator = validator() -> make($parametrosArray,[
            'id_equipo'             =>          'required|integer'
        ]);

        if($validator -> fails())

            return response() -> json([
                'mensaje'           =>          'error_validacion',
                'errores'           =>          $validator -> errors()
            ], 500);

        $objProyecto = Proyecto::find($parametrosArray['id_proyecto']);
       
        $integrantes = $parametrosArray['integrantes'];

        foreach($integrantes as $integrante)
            $objProyecto -> attach($integrante['id']);

        return response() -> json([
            'mensaje'               =>          'agregados',
            'proyecto'              =>          $objProyecto
        ], 200);

    }

    public function Crear(){

        $json = request() -> input('json');
        $parametrosArray = json_decode($json, true);

        $validator = validator() -> make($parametrosArray,[
            'nombres'                =>          'required|string',
            'apellidos'              =>          'required|string',
            'email'                  =>          'required|string|email'
        ]);

        if($validator -> fails())

            return response() -> json([
                'mensaje'           =>          'error_validacion',
                'errores'           =>          $validator -> errors()
            ], 500);

        $integrante = new Integrante($parametrosArray);
        

        $integrante -> save();

        return response() -> json([
            'mensaje'           =>          'integrante_creado',
            'intengrate'        =>          $integrante
        ], 200);

    }

    public function Eliminar(){

        $json = request() -> input('json');
        $parametrosArray = json_decode($json, true);

        $integrante = $this -> Buscar($parametrosArray['id']);

        $integrante -> reg_status = 1;

        $integrante -> save();

        return response() -> json([
            'mensaje'               =>          'integrante_eliminado',
            'integrante'            =>          $integrante
        ], 200);

    }


}
