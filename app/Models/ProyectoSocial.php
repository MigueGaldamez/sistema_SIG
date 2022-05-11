<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoSocial extends Model
{
    use HasFactory;
    protected $table = 'proyectos_sociales_g';
    protected $primaryKey = 'id';

    protected $fillable = [
        'peticion_id',
        'estado_proyecto_social'
    ]; 
}
