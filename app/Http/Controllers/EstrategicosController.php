<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facultad;
use App\Models\Carrera;
use App\Models\ConstanciaCumplimiento;
use App\Models\ConstanciaProyecto;
use App\Models\Estudiante;
use App\Models\Institucion;
use App\Models\Peticion;
use App\Models\TipoServicio;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EstrategicosController extends Controller
{
    //
    public function mostrarEstrategico1(Request $request){

        $consulta = DB::table('proyectos_sociales_g')
        ->select('proyectos_sociales_g.id','peticiones_g.nombre_peticion',
        'peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social',
        'tipos_servicio_social_g.nombre_tipo_servicio','carreras_g.nombre_carrera','facultades_g.nombre_facultad')
        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
        ->where('proyectos_sociales_g.estado_proyecto_social','=','Finalizado')
        ->get();

        $cuenta = DB::table('proyectos_sociales_g')
        ->select('proyectos_sociales_g.id','peticiones_g.nombre_peticion',
        'peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social',
        'tipos_servicio_social_g.nombre_tipo_servicio','carreras_g.nombre_carrera','facultad_g.nombre_facultad')
        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
        ->where('proyectos_sociales_g.estado_proyecto_social','=','Finalizado')
        ->count();

        $tipos = TipoServicio::all();
        return view('paginas.estrategicos.reporteestrategico1', compact('consulta','cuenta','tipos'));
    }
    public function mostrarEstrategico2(Request $request){

        $cuenta = Estudiante::where('cantidad_horas_ss','>=',500)->select('sexo_estudiante',DB::raw('count(*) as total'))->groupby('sexo_estudiante')->get();
        $consulta = DB::table('proyectos_sociales_g')
        ->select('proyectos_sociales_g.id','peticiones_g.nombre_peticion','peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social','tipos_servicio_social_g.nombre_tipo_servicio')
        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
        ->where('proyectos_sociales_g.estado_proyecto_social','=','Finalizado')
        ->get();
        foreach($consulta as $consu ){
            $subconsulta = ConstanciaProyecto::where("proyecto_social_id","=",$consu->id)->pluck('constancia_cumplimiento_id');
            $estudiantes = ConstanciaCumplimiento::whereIn('id',$subconsulta)->pluck('estudiante_id');
            $ellas = Estudiante::wherein('id',$estudiantes)->where('sexo_estudiante','=','Femenino')->count();
            $ellos = Estudiante::wherein('id',$estudiantes)->where('sexo_estudiante','=','Masculino')->count();
            $consu->masculino = $ellos;
            $consu->femenino = $ellas;
        }
       
        return view('paginas.estrategicos.reporteestrategico2', compact('consulta','cuenta'));
    }
    public function filtrarEstrategico1(Request $request){
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        $servicio = $request->tipo_servicio;
        if($inicio=="" && $fin=="" && $servicio==0){
            $consulta = DB::table('proyectos_sociales_g')
            ->select('proyectos_sociales_g.id','peticiones_g.nombre_peticion',
            'peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social',
            'tipos_servicio_social_g.nombre_tipo_servicio','carreras_g.nombre_carrera','facultades_g.nombre_facultad')
            ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
            ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
            ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
            ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
            ->where('proyectos_sociales_g.estado_proyecto_social','=','Finalizado')
            ->get();
    
            $cuenta = DB::table('proyectos_sociales_g')
            ->select('proyectos_sociales_g.id','peticiones_g.nombre_peticion',
            'peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social',
            'tipos_servicio_social_g.nombre_tipo_servicio','carreras_g.nombre_carrera','facultad_g.nombre_facultad')
            ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
            ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
            ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
            ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
            ->where('proyectos_sociales_g.estado_proyecto_social','=','Finalizado')
            ->count();

            return view('paginas.estrategicos.tablaestrategico1', compact('consulta','cuenta'));
        }
        else{
            if($inicio=="" || $fin==""){
                if($servicio!=0 && $servicio!=""){
                    $consulta = DB::table('proyectos_sociales_g')
                    ->select('proyectos_sociales_g.id','peticiones_g.nombre_peticion',
                    'peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social',
                    'tipos_servicio_social_g.nombre_tipo_servicio','carreras_g.nombre_carrera','facultades_g.nombre_facultad')
                    ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                    ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                    ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                    ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                    ->where('proyectos_sociales_g.estado_proyecto_social','=','Finalizado')
                    ->where('tipos_servicio_social_g.id','=',$servicio)
                    ->get();
            
                    $cuenta = DB::table('proyectos_sociales_g')
                    ->select('proyectos_sociales_g.id','peticiones_g.nombre_peticion',
                    'peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social',
                    'tipos_servicio_social_g.nombre_tipo_servicio','carreras_g.nombre_carrera','facultad_g.nombre_facultad')
                    ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                    ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                    ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                    ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                    ->where('proyectos_sociales_g.estado_proyecto_social','=','Finalizado')
                    ->where('tipos_servicio_social_g.id','=',$servicio)
                    ->count();

                    return view('paginas.estrategicos.tablaestrategico1', compact('consulta','cuenta'));
                }
            }else{
                $inicio = Carbon::parse($request->fecha_inicio);
                $fin = Carbon::parse($request->fecha_fin);
                if($fin->gt($inicio)){
                    if($servicio!=0 && $servicio!=""){
                        $consulta = DB::table('proyectos_sociales_g')
                        ->select('proyectos_sociales_g.id','peticiones_g.nombre_peticion',
                        'peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social',
                        'tipos_servicio_social_g.nombre_tipo_servicio','carreras_g.nombre_carrera','facultades_g.nombre_facultad')
                        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                        ->where('proyectos_sociales_g.estado_proyecto_social','=','Finalizado')
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                        ->where('tipos_servicio_social_g.id','=',$servicio)
                        ->get();
                
                        $cuenta = DB::table('proyectos_sociales_g')
                        ->select('proyectos_sociales_g.id','peticiones_g.nombre_peticion',
                        'peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social',
                        'tipos_servicio_social_g.nombre_tipo_servicio','carreras_g.nombre_carrera','facultad_g.nombre_facultad')
                        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                        ->where('proyectos_sociales_g.estado_proyecto_social','=','Finalizado')
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                        ->where('tipos_servicio_social_g.id','=',$servicio)
                        ->count();
    
                        return view('paginas.estrategicos.tablaestrategico1', compact('consulta','cuenta'));
                    }else{
                        $consulta = DB::table('proyectos_sociales_g')
                        ->select('proyectos_sociales_g.id','peticiones_g.nombre_peticion',
                        'peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social',
                        'tipos_servicio_social_g.nombre_tipo_servicio','carreras_g.nombre_carrera','facultades_g.nombre_facultad')
                        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                        ->where('proyectos_sociales_g.estado_proyecto_social','=','Finalizado')
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                        ->get();
                
                        $cuenta = DB::table('proyectos_sociales_g')
                        ->select('proyectos_sociales_g.id','peticiones_g.nombre_peticion',
                        'peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social',
                        'tipos_servicio_social_g.nombre_tipo_servicio','carreras_g.nombre_carrera','facultad_g.nombre_facultad')
                        ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                        ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                        ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                        ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                        ->where('proyectos_sociales_g.estado_proyecto_social','=','Finalizado')
                        ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                        ->count();
            
                        return view('paginas.estrategicos.tablaestrategico1', compact('consulta','cuenta'));
                    }
                }
            }


       
        }
        return "aqui van los datos";

    }

    public function filtrarEstrategico2(Request $request){
        
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        if($inicio=="" && $fin==""){
            $cuenta = Estudiante::where('cantidad_horas_ss','>=',500)->select('sexo_estudiante',DB::raw('count(*) as total'))->groupby('sexo_estudiante')->get();
            $consulta = DB::table('proyectos_sociales_g')
            ->select('proyectos_sociales_g.id','peticiones_g.nombre_peticion','peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social','tipos_servicio_social_g.nombre_tipo_servicio')
            ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
            ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
            ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
            ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
            ->where('proyectos_sociales_g.estado_proyecto_social','=','Finalizado')
            ->get();
            foreach($consulta as $consu ){
                $subconsulta = ConstanciaProyecto::where("proyecto_social_id","=",$consu->id)->pluck('constancia_cumplimiento_id');
                $estudiantes = ConstanciaCumplimiento::whereIn('id',$subconsulta)->pluck('estudiante_id');
                $ellas = Estudiante::wherein('id',$estudiantes)->where('sexo_estudiante','=','Femenino')->count();
                $ellos = Estudiante::wherein('id',$estudiantes)->where('sexo_estudiante','=','Masculino')->count();
                $consu->masculino = $ellos;
                $consu->femenino = $ellas;
            }
           
            return view('paginas.estrategicos.tablaestrategico2', compact('consulta','cuenta'));

        }
        else{
            $inicio = Carbon::parse($request->fecha_inicio);
            $fin = Carbon::parse($request->fecha_fin);
            if($fin->gt($inicio)){
                $cuenta = Estudiante::where('cantidad_horas_ss','>=',500)->select('sexo_estudiante',DB::raw('count(*) as total'))->groupby('sexo_estudiante')->get();
                $consulta = DB::table('proyectos_sociales_g')
                ->select('proyectos_sociales_g.id','peticiones_g.nombre_peticion','peticiones_g.cantidad_estudiantes','proyectos_sociales_g.estado_proyecto_social','tipos_servicio_social_g.nombre_tipo_servicio')
                ->join('peticiones_g','peticiones_g.id','proyectos_sociales_g.peticion_id')
                ->join('carreras_g', 'peticiones_g.carrera_id', '=', 'carreras_g.id')
                ->join('facultades_g', 'carreras_g.facultad_id', '=', 'facultades_g.id')
                ->join('tipos_servicio_social_g','tipos_servicio_social_g.id','peticiones_g.tipo_servicio_social_id')
                ->where('proyectos_sociales_g.estado_proyecto_social','=','Finalizado')
                ->whereBetween('peticiones_g.created_at',[$inicio,$fin])
                ->get();
                foreach($consulta as $consu ){
                    $subconsulta = ConstanciaProyecto::where("proyecto_social_id","=",$consu->id)->pluck('constancia_cumplimiento_id');
                    $estudiantes = ConstanciaCumplimiento::whereIn('id',$subconsulta)->pluck('estudiante_id');
                    $ellas = Estudiante::wherein('id',$estudiantes)->where('sexo_estudiante','=','Femenino')->count();
                    $ellos = Estudiante::wherein('id',$estudiantes)->where('sexo_estudiante','=','Masculino')->count();
                    $consu->masculino = $ellos;
                    $consu->femenino = $ellas;
                }
            
                return view('paginas.estrategicos.tablaestrategico2', compact('consulta','cuenta'));
            }
        }
    }
}
