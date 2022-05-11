<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $table = 'estudiantes_g';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_estudiante',
        'apellido_estudiante',
        'carrera_id',
        'carnet_estudiante',
        'sexo_estudiante',
        'cantidad_horas_ss',
        'estado_estudiante',
    ];
    public function carrera()
    {
            return $this->belongsTo(Carrera::class, 'id');
    }   
}
