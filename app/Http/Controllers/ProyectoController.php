<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;

class ProyectoController extends Controller
{

    public function index(){

        return view('proyecto/proyecto');

    }
    
    public function Listar(){

        $proyectos = Proyecto::where('reg_status','=',1)
            ->get();

        return $proyectos;

    }

    public function Buscar($id){

            $proyecto = Proyecto::find($id);

        return $proyecto;

    }

    public function Crear(){

        $json = request() -> input('json');
        $parametrosArray = json_decode($json, true);

        $validacion = validator() -> make($parametrosArray,[
            'nombre'            =>      'required|string',
            'descripcion'       =>      'required|string',
            'calificacion'      =>      'required|integer'
        ]);

        if($validacion -> fails())

            return response() -> json([
                'mensaje'           =>          'error_validacion',
                'errores'           =>          $validacion -> errors()
            ],500);
        
        $objProyecto = new Proyecto($parametrosArray);

        $objProyecto -> reg_status = 1;
        
        $objProyecto -> save();

        return response() -> json([
            'mensaje'           =>          'proyecto_creado',
            'proyecto'          =>          $objProyecto
        ],200);

    }

    public function Actualizar(){

        $json = request() -> input('json');
        $parametrosArray = json_decode($json, true);

        $objProyecto = $this -> Buscar($parametrosArray['id']);

        $validacion = validator() -> make($parametrosArray,[
            'nombre'            =>      'required|string',
            'descripcion'       =>      'required|string',
            'calificacion'      =>      'required|integer'
        ]);


        if($validacion -> fails())

            return response() -> json([
                'mensaje'           =>          'error_validacion',
                'errores'           =>          $validacion -> errors()
            ],500);

        $objProyecto -> nombre = $parametrosArray['nombre'];
        $objProyecto -> descripcion = $parametrosArray['descripcion'];
        $objProyecto -> calificacion = $parametrosArray['calificacion'];

        $objProyecto -> save();

        return response() -> json([
            'mensaje'           =>          'proyecto_actualizado',
            'proyecto'          =>          $objProyecto
        ], 200);
        
    }

    public function Eliminar(){

        $json = request() -> input('json');
        $parametrosArray = json_decode($json, true);

        $objProyecto = $this -> Buscar($parametrosArray['id']);

        $objProyecto -> reg_status = 0;

        $objProyecto -> save();

        return response() -> json([
            'mensaje'           =>          'proyecto_eliminado',
            'proyecto'          =>          $objProyecto
        ], 200);

    }



}
