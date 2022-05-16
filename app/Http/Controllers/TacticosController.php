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
use Carbon\Carbon;
use PDF;
class TacticosController extends Controller
{
    //
    public function mostrarTactico1(Request $request){
        $preconsulta =  DB::table('proyectos_sociales_g')
        ->join('peticiones_g', 'peticiones_g.id', '=', 'proyectos_sociales_g.peticion_id')
        ->where('proyectos_sociales_g.estado_proyecto_social','=','En curso')->pluck('peticiones_g.id');
        
        $consulta = DB::table('peticiones_g')
        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')  
        ->whereIn('peticiones_g.id',$preconsulta)      
        ->sum('cantidad_estudiantes');

        $consulta2 = DB::table('peticiones_g')
        ->select('facultades_g.nombre_facultad','carreras_g.nombre_carrera', DB::raw('SUM(cantidad_estudiantes) AS "estudiantes"'))
        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
        ->whereIn('peticiones_g.id',$preconsulta)      
        ->groupby('facultades_g.nombre_facultad','carreras_g.nombre_carrera')
        ->get();

        $facultades = Facultad::all();
        return view('paginas.tacticos.reportetactico1', compact('consulta','consulta2','facultades'));
        
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
        ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio', DB::raw('count(*) AS "servicios"'))
        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
        ->groupby('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio')
        ->get();

        $consulta2 = DB::table('proyectos_sociales_g')
        ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad', DB::raw('count(*) AS "servicios"'))
        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
        ->count();

        $tipos = TipoServicio::all();
        
        return view('paginas.tacticos.reportetactico3', compact('consulta','consulta2','tipos'));
        
    }

    public function filtrarTactico1(Request $request){
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        $facultad = $request->facultad;
       
        if($inicio=="" && $fin=="" && $facultad==0){
            $preconsulta =  DB::table('proyectos_sociales_g')
            ->join('peticiones_g', 'peticiones_g.id', '=', 'proyectos_sociales_g.peticion_id')
            ->where('proyectos_sociales_g.estado_proyecto_social','=','En curso')->pluck('peticiones_g.id');
            
            $consulta = DB::table('peticiones_g')
            ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
            ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')  
            ->whereIn('peticiones_g.id',$preconsulta)      
            ->sum('cantidad_estudiantes');

            $consulta2 = DB::table('peticiones_g')
            ->select('facultades_g.nombre_facultad','carreras_g.nombre_carrera', DB::raw('SUM(cantidad_estudiantes) AS "estudiantes"'))
            ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
            ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
            ->whereIn('peticiones_g.id',$preconsulta)      
            ->groupby('facultades_g.nombre_facultad','carreras_g.nombre_carrera')
            ->get();
    
            $facultades = Facultad::all();
            return view('paginas.tacticos.tablatactico1', compact('consulta','consulta2','facultades'));
        }else{
            if($inicio=="" || $fin==""){
                if($facultad!=0 && $facultad!=""){
                    $carreras = Carrera::where('facultad_id','=',$facultad)->pluck('id');
                    $preconsulta =  DB::table('proyectos_sociales_g')
                    ->join('peticiones_g', 'peticiones_g.id', '=', 'proyectos_sociales_g.peticion_id')
                    ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                    ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                    ->whereIn('peticiones_g.carrera_id',$carreras)
                    ->where('proyectos_sociales_g.estado_proyecto_social','=','En curso')->pluck('peticiones_g.id');
                    
                    $consulta = DB::table('peticiones_g')
                    ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                    ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                    ->whereIn('peticiones_g.carrera_id',$carreras)    
                    ->whereIn('peticiones_g.id',$preconsulta)   
                    ->sum('cantidad_estudiantes');

                    $consulta2 = DB::table('peticiones_g')
                    ->select('facultades_g.nombre_facultad','carreras_g.nombre_carrera', DB::raw('SUM(cantidad_estudiantes) AS "estudiantes"'))
                    ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                    ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                    ->whereIn('peticiones_g.carrera_id',$carreras)
                    ->whereIn('peticiones_g.id',$preconsulta)     
                    ->groupby('facultades_g.nombre_facultad','carreras_g.nombre_carrera')
                    ->get();
            
                    $facultades = Facultad::all();
                    return view('paginas.tacticos.tablatactico1', compact('consulta','consulta2','facultades'));
                }
            }else{
                $inicio = Carbon::parse($request->fecha_inicio);
                $fin = Carbon::parse($request->fecha_fin);
                if($fin->gt($inicio)){
                    if($facultad!=0 && $facultad!=""){
                        $carreras = Carrera::where('facultad_id','=',$facultad)->pluck('id');
                        $preconsulta =  DB::table('proyectos_sociales_g')
                        ->join('peticiones_g', 'peticiones_g.id', '=', 'proyectos_sociales_g.peticion_id')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->whereIn('peticiones_g.carrera_id',$carreras)
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                        ->where('proyectos_sociales_g.estado_proyecto_social','=','En curso')->pluck('peticiones_g.id');
                        
                        $consulta = DB::table('peticiones_g')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->whereIn('peticiones_g.carrera_id',$carreras)
                        ->whereIn('peticiones_g.id',$preconsulta)   
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])      
                        ->sum('cantidad_estudiantes');

                        $consulta2 = DB::table('peticiones_g')
                        ->select('facultades_g.nombre_facultad','carreras_g.nombre_carrera', DB::raw('SUM(cantidad_estudiantes) AS "estudiantes"'))
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->whereIn('peticiones_g.carrera_id',$carreras)
                        ->whereIn('peticiones_g.id',$preconsulta)
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])      
                        ->groupby('facultades_g.nombre_facultad','carreras_g.nombre_carrera')
                        ->get();
                
                        $facultades = Facultad::all();
                        return view('paginas.tacticos.tablatactico1', compact('consulta','consulta2','facultades'));
                    }else{
                        $carreras = Carrera::pluck('id');
                        $preconsulta =  DB::table('proyectos_sociales_g')
                        ->join('peticiones_g', 'peticiones_g.id', '=', 'proyectos_sociales_g.peticion_id')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                        ->where('proyectos_sociales_g.estado_proyecto_social','=','En curso')->pluck('peticiones_g.id');
                        
                        $consulta = DB::table('peticiones_g')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->whereIn('peticiones_g.id',$preconsulta)   
                        ->whereIn('peticiones_g.carrera_id',$carreras)
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])      
                        ->sum('cantidad_estudiantes');

                        $consulta2 = DB::table('peticiones_g')
                        ->select('facultades_g.nombre_facultad','carreras_g.nombre_carrera', DB::raw('SUM(cantidad_estudiantes) AS "estudiantes"'))
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->whereIn('peticiones_g.carrera_id',$carreras)
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])      
                        ->whereIn('peticiones_g.id',$preconsulta)
                        ->groupby('facultades_g.nombre_facultad','carreras_g.nombre_carrera')
                        ->get();
                
                        $facultades = Facultad::all();
                        return view('paginas.tacticos.tablatactico1', compact('consulta','consulta2','facultades'));
                    }
                }
            }
        }
    }

    public function filtrarTactico2(Request $request){
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        if($inicio=="" && $fin==""){
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
            return view('paginas.tacticos.tablatactico2', compact('consulta','consulta2'));
        }
        else{
            $inicio = Carbon::parse($request->fecha_inicio);
            $fin = Carbon::parse($request->fecha_fin);
            if($fin->gt($inicio)){
                $consulta = DB::table('proyectos_sociales_g')
                ->select('instituciones_g.nombre_institucion', 'peticiones_g.nombre_peticion','peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social','tipos_servicio_social_g.nombre_tipo_servicio')
                ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                ->join('instituciones_g','instituciones_g.id','peticiones_g.institucion_id')
                ->where('proyectos_sociales_g.estado_proyecto_social','=','En curso')
                ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                ->get();
                $consulta2 = DB::table('proyectos_sociales_g')
                ->select('instituciones_g.nombre_institucion', 'peticiones_g.nombre_peticion','peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social','tipos_servicio_social_g.nombre_tipo_servicio')
                ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                ->join('instituciones_g','instituciones_g.id','peticiones_g.institucion_id')
                ->where('proyectos_sociales_g.estado_proyecto_social','=','En curso')
                ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                ->count();
                return view('paginas.tacticos.tablatactico2', compact('consulta','consulta2'));
            }
        }
    }

    public function filtrarTactico3(Request $request){
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        $tipo = $request->tipo;
       
        if($inicio=="" && $fin=="" && $tipo==0){
            $consulta = DB::table('proyectos_sociales_g')
            ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio', DB::raw('count(*) AS "servicios"'))
            ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
            ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
            ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
            ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
            ->groupby('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio')
            ->get();
    
            $consulta2 = DB::table('proyectos_sociales_g')
            ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad', DB::raw('count(*) AS "servicios"'))
            ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
            ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
            ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
            ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
            ->count();
    
            $tipos = TipoServicio::all();
            
            return view('paginas.tacticos.tablatactico3', compact('consulta','consulta2','tipos'));
            
        }else{
            if($inicio=="" || $fin==""){
                if($tipo!=0 && $tipo!=""){
                    $consulta = DB::table('proyectos_sociales_g')
                    ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio', DB::raw('count(*) AS "servicios"'))
                    ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                    ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                    ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                    ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                    ->where('tipos_servicio_social_g.id','=',$tipo)
                    ->groupby('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio')
                    ->get();
            
                    $consulta2 = DB::table('proyectos_sociales_g')
                    ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad', DB::raw('count(*) AS "servicios"'))
                    ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                    ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                    ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                    ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                    ->where('tipos_servicio_social_g.id','=',$tipo)
                    ->count();
            
                    $tipos = TipoServicio::all();
                    
                    return view('paginas.tacticos.tablatactico3', compact('consulta','consulta2','tipos'));
                }
            }else{
                $inicio = Carbon::parse($request->fecha_inicio);
                $fin = Carbon::parse($request->fecha_fin);
                if($fin->gt($inicio)){
                    if($tipo!=0 && $tipo!=""){
                        $consulta = DB::table('proyectos_sociales_g')
                        ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio', DB::raw('count(*) AS "servicios"'))
                        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                        ->where('tipos_servicio_social_g.id','=',$tipo)
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                        ->groupby('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio')
                        ->get();
                
                        $consulta2 = DB::table('proyectos_sociales_g')
                        ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad', DB::raw('count(*) AS "servicios"'))
                        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                        ->where('tipos_servicio_social_g.id','=',$tipo)
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                        ->count();
                
                        $tipos = TipoServicio::all();
                        
                        return view('paginas.tacticos.tablatactico3', compact('consulta','consulta2','tipos'));
                    }else{
                        $consulta = DB::table('proyectos_sociales_g')
                        ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio', DB::raw('count(*) AS "servicios"'))
                        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                        ->groupby('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio')
                        ->get();
                
                        $consulta2 = DB::table('proyectos_sociales_g')
                        ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad', DB::raw('count(*) AS "servicios"'))
                        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                        ->count();
                
                        $tipos = TipoServicio::all();
                        
                        return view('paginas.tacticos.tablatactico3', compact('consulta','consulta2','tipos'));
                    }
                }
            }
        }

    }

    public function pdftactico1(Request $request)
    {
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        $facultad = $request->facultad;
        $fac="";
        $consulta2 ="";
        $consulta ="";
        if($inicio=="" && $fin=="" && $facultad==0){
            $preconsulta =  DB::table('proyectos_sociales_g')
            ->join('peticiones_g', 'peticiones_g.id', '=', 'proyectos_sociales_g.peticion_id')
            ->where('proyectos_sociales_g.estado_proyecto_social','=','En curso')->pluck('peticiones_g.id');
           
            $consulta = DB::table('peticiones_g')
            ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
            ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')  
            ->whereIn('peticiones_g.id',$preconsulta)
            ->sum('cantidad_estudiantes');

            $consulta2 = DB::table('peticiones_g')
            ->select('facultades_g.nombre_facultad','carreras_g.nombre_carrera', DB::raw('SUM(cantidad_estudiantes) AS "estudiantes"'))
            ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
            ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
            ->whereIn('peticiones_g.id',$preconsulta)      
            ->groupby('facultades_g.nombre_facultad','carreras_g.nombre_carrera')
            ->get();

        }else{
            if($inicio=="" || $fin==""){
                if($facultad!=0 && $facultad!=""){
                    $fac = Facultad::findorfail($facultad)->nombre_facultad;
                    $carreras = Carrera::where('facultad_id','=',$facultad)->pluck('id');
                    $preconsulta =  DB::table('proyectos_sociales_g')
                    ->join('peticiones_g', 'peticiones_g.id', '=', 'proyectos_sociales_g.peticion_id')
                    ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                    ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                    ->whereIn('peticiones_g.carrera_id',$carreras)
                    ->where('proyectos_sociales_g.estado_proyecto_social','=','En curso')->pluck('peticiones_g.id');
                    
                    $consulta = DB::table('peticiones_g')
                    ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                    ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                    ->whereIn('peticiones_g.carrera_id',$carreras) 
                    ->whereIn('peticiones_g.id',$preconsulta)          
                    ->sum('cantidad_estudiantes');

                    $consulta2 = DB::table('peticiones_g')
                    ->select('facultades_g.nombre_facultad','carreras_g.nombre_carrera', DB::raw('SUM(cantidad_estudiantes) AS "estudiantes"'))
                    ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                    ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                    ->whereIn('peticiones_g.carrera_id',$carreras)
                    ->whereIn('peticiones_g.id',$preconsulta)      
                    ->groupby('facultades_g.nombre_facultad','carreras_g.nombre_carrera')
                    ->get();
            
               }
            }else{
                $inicio = Carbon::parse($request->fecha_inicio);
                $fin = Carbon::parse($request->fecha_fin);
                if($fin->gt($inicio)){
                    if($facultad!=0 && $facultad!=""){
                        $fac = Facultad::findorfail($facultad)->nombre_facultad;
                        $carreras = Carrera::where('facultad_id','=',$facultad)->pluck('id');
                        $preconsulta =  DB::table('proyectos_sociales_g')
                        ->join('peticiones_g', 'peticiones_g.id', '=', 'proyectos_sociales_g.peticion_id')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->whereIn('peticiones_g.carrera_id',$carreras)
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                        ->where('proyectos_sociales_g.estado_proyecto_social','=','En curso')->pluck('peticiones_g.id');
                        
                        $consulta = DB::table('peticiones_g')->whereIn('id',$preconsulta)->sum('cantidad_estudiantes');
                
                        $consulta2 = DB::table('peticiones_g')
                        ->select('facultades_g.nombre_facultad','carreras_g.nombre_carrera', DB::raw('SUM(cantidad_estudiantes) AS "estudiantes"'))
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->whereIn('peticiones_g.carrera_id',$carreras)
                        ->whereIn('peticiones_g.id',$preconsulta)
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])      
                        ->groupby('facultades_g.nombre_facultad','carreras_g.nombre_carrera')
                        ->get();
            
                    }else{
                        $carreras = Carrera::pluck('id');
                        $preconsulta =  DB::table('proyectos_sociales_g')
                        ->join('peticiones_g', 'peticiones_g.id', '=', 'proyectos_sociales_g.peticion_id')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                        ->where('proyectos_sociales_g.estado_proyecto_social','=','En curso')->pluck('peticiones_g.id');
                        
                        $consulta = DB::table('peticiones_g')->whereIn('id',$preconsulta)->sum('cantidad_estudiantes');
                
                        $consulta2 = DB::table('peticiones_g')
                        ->select('facultades_g.nombre_facultad','carreras_g.nombre_carrera', DB::raw('SUM(cantidad_estudiantes) AS "estudiantes"'))
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->whereIn('peticiones_g.carrera_id',$carreras)
                        ->whereIn('peticiones_g.id',$preconsulta)
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])      
                        ->groupby('facultades_g.nombre_facultad','carreras_g.nombre_carrera')
                        ->get();
                    }
                }
            }
        }
        
        

        $data = [
            'titulo' => 'Sistema informatico gerencial para la administracion del servicio social de la universidad de El Salvador',
            'fecha' => date('m/d/Y'),
            'descripcion'=>'Cantidad de alumnos que están realizando su servicio social por facultad.',
            'consulta' => $consulta2,
            'total' => $consulta,
            'fecha_inicio' =>$inicio,
            'fecha_fin' =>$fin,
            'facultad' =>$fac,
        ]; 
        //return view('paginas.tacticos.pdftactico1',$data);
        $pdf = PDF::loadView('paginas.tacticos.pdftactico1', $data);
        return $pdf->download('reporte_tactico_1.pdf');
    }

    public function pdftactico2(Request $request){

        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        $consulta2 ="";
        $consulta ="";

        if($inicio=="" && $fin==""){
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
        }
        else{
            $inicio = Carbon::parse($request->fecha_inicio);
            $fin = Carbon::parse($request->fecha_fin);
            if($fin->gt($inicio)){
                $consulta = DB::table('proyectos_sociales_g')
                ->select('instituciones_g.nombre_institucion', 'peticiones_g.nombre_peticion','peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social','tipos_servicio_social_g.nombre_tipo_servicio')
                ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                ->join('instituciones_g','instituciones_g.id','peticiones_g.institucion_id')
                ->where('proyectos_sociales_g.estado_proyecto_social','=','En curso')
                ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                ->get();
                $consulta2 = DB::table('proyectos_sociales_g')
                ->select('instituciones_g.nombre_institucion', 'peticiones_g.nombre_peticion','peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social','tipos_servicio_social_g.nombre_tipo_servicio')
                ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                ->join('instituciones_g','instituciones_g.id','peticiones_g.institucion_id')
                ->where('proyectos_sociales_g.estado_proyecto_social','=','En curso')
                ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                ->count();
            }
        }
        
        $data = [
            'titulo' => 'Sistema informatico gerencial para la administracion del servicio social de la universidad de El Salvador',
            'fecha' => date('m/d/Y'),
            'descripcion'=>'instituciones que tienen servicios sociales activos o inactivos.',
            'consulta2' => $consulta2,
            'consulta' => $consulta,
            'fecha_inicio' =>$inicio,
            'fecha_fin' =>$fin,
        ]; 
        //return view('paginas.tacticos.pdftactico1',$data);
        $pdf = PDF::loadView('paginas.tacticos.pdftactico2', $data);
        return $pdf->download('reporte_tactico_2.pdf');
    }

    public function pdftactico3(Request $request){
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        $tipo= $request->tipo;
        $serv="";
        $consulta2 ="";
        $consulta ="";

        if($inicio=="" && $fin=="" && $tipo==0){
            $consulta = DB::table('proyectos_sociales_g')
            ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio', DB::raw('count(*) AS "servicios"'))
            ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
            ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
            ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
            ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
            ->groupby('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio')
            ->get();
    
            $consulta2 = DB::table('proyectos_sociales_g')
            ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad', DB::raw('count(*) AS "servicios"'))
            ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
            ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
            ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
            ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
            ->count();
            
        }else{
            if($inicio=="" || $fin==""){
                if($tipo!=0 && $tipo!=""){
                    $serv=TipoServicio::findorfail($tipo)->nombre_tipo_servicio;
                    $consulta = DB::table('proyectos_sociales_g')
                    ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio', DB::raw('count(*) AS "servicios"'))
                    ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                    ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                    ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                    ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                    ->where('tipos_servicio_social_g.id','=',$tipo)
                    ->groupby('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio')
                    ->get();
            
                    $consulta2 = DB::table('proyectos_sociales_g')
                    ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad', DB::raw('count(*) AS "servicios"'))
                    ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                    ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                    ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                    ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                    ->where('tipos_servicio_social_g.id','=',$tipo)
                    ->count();
            
                }
            }else{
                $inicio = Carbon::parse($request->fecha_inicio);
                $fin = Carbon::parse($request->fecha_fin);
                if($fin->gt($inicio)){
                    if($tipo!=0 && $tipo!=""){
                        $serv=TipoServicio::findorfail($tipo)->nombre_tipo_servicio;
                        $consulta = DB::table('proyectos_sociales_g')
                        ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio', DB::raw('count(*) AS "servicios"'))
                        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                        ->where('tipos_servicio_social_g.id','=',$tipo)
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                        ->groupby('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio')
                        ->get();
                
                        $consulta2 = DB::table('proyectos_sociales_g')
                        ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad', DB::raw('count(*) AS "servicios"'))
                        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                        ->where('tipos_servicio_social_g.id','=',$tipo)
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                        ->count();
                
                    }else{
                        $consulta = DB::table('proyectos_sociales_g')
                        ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio', DB::raw('count(*) AS "servicios"'))
                        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                        ->groupby('carreras_g.nombre_carrera','facultades_g.nombre_facultad','tipos_servicio_social_g.nombre_tipo_servicio')
                        ->get();
                
                        $consulta2 = DB::table('proyectos_sociales_g')
                        ->select('carreras_g.nombre_carrera','facultades_g.nombre_facultad', DB::raw('count(*) AS "servicios"'))
                        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                        ->count();
                    }
                }
            }
        }

        $data = [
            'titulo' => 'Sistema informatico gerencial para la administracion del servicio social de la universidad de El Salvador',
            'fecha' => date('m/d/Y'),
            'descripcion'=>'servicios sociales que han sido finalizados ordenados por su tipo mostrando la cantidad de alumnos que participaron en el servicio social.',
            'consulta' => $consulta,
            'consulta2' => $consulta2,
            'fecha_inicio' =>$inicio,
            'fecha_fin' =>$fin,
            'servicio' =>$serv,
        ]; 
        //return view('paginas.tacticos.pdftactico1',$data);
        $pdf = PDF::loadView('paginas.tacticos.pdftactico3', $data);
        return $pdf->download('reporte_tactico3_.pdf');
    }
}


