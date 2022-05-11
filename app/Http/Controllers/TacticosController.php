<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facultad;
use App\Models\Carrera;
use App\Models\Estudiante;
use App\Models\Institucion;
use App\Models\Peticion;
use App\Models\TipoServicio;
use Illuminate\Support\Facades\DB;

class TacticosController extends Controller
{
    //
    public function mostrarTactico1(Request $request){
        $preconsulta =  DB::table('proyectos_sociales_g')
        ->join('peticiones_g', 'peticiones_g.id', '=', 'proyectos_sociales_g.peticion_id')
        ->where('proyectos_sociales_g.estado_proyecto_social','=','En curso')->pluck('peticiones_g.id');
        $consulta = DB::table('peticiones_g')->whereIn('id',$preconsulta)->sum('cantidad_estudiantes');

        $consulta2 = DB::table('peticiones_g')
        ->select('facultades_g.nombre_facultad', DB::raw('SUM(cantidad_estudiantes) AS "estudiantes"'))
        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
        ->whereIn('peticiones_g.id',$preconsulta)      
        ->groupby('facultades_g.nombre_facultad')
        ->get();
        return view('paginas.tacticos.reportetactico1', compact('consulta','consulta2'));
        
    }
    public function mostrarTactico2(Request $request){
        
        $consulta = DB::table('proyectos_sociales_g')
        ->select('instituciones_g.nombre_institucion', 'peticiones_g.nombre_peticion','peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social','tipos_servicio_social_g.nombre_tipo_servicio')
        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
        ->join('instituciones_g','instituciones_g.id','peticiones_g.institucion_id')
        ->where('proyectos_sociales_g.estado_proyecto_social','=','En curso')
        ->get();
        $consulta2 = DB::table('proyectos_sociales_g')
        ->select('instituciones_g.nombre_institucion', 'peticiones_g.nombre_peticion','peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social','tipos_servicio_social_g.nombre_tipo_servicio')
        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
        ->join('instituciones_g','instituciones_g.id','peticiones_g.institucion_id')
        ->where('proyectos_sociales_g.estado_proyecto_social','=','En curso')
        ->count();
        return view('paginas.tacticos.reportetactico2', compact('consulta','consulta2'));
        
    }
    public function mostrarTactico3(Request $request){

        $consulta = DB::table('proyectos_sociales_g')
        ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad', DB::raw('count(*) AS "servicios"'))
        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
        ->groupby('carreras_g.nombre_carrera','facultades_g.nombre_facultad')
        ->get();

        $consulta2 = DB::table('proyectos_sociales_g')
        ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad', DB::raw('count(*) AS "servicios"'))
        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
        ->count();

        
        return view('paginas.tacticos.reportetactico3', compact('consulta','consulta2'));
        
    }
}
