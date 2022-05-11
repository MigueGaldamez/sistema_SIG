<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peticion extends Model
{
    use HasFactory;
    protected $table = 'peticiones_g';
    protected $primaryKey = 'id';

    protected $fillable = [
        'cantidad_estudiantes',
        'nombre_peticion',
        'fecha_peticion',
        'fecha_peticion_fin',
        'cantidad_horas',
        'estado_peticion',
        'carrera_id',
        'tipo_servicio_social_id',
        'institucion_id',
    ]; 
}
