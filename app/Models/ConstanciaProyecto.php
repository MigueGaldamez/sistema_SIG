<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstanciaProyecto extends Model
{
    use HasFactory;
    protected $table = 'constancia_c_proyecto_s_g';
    protected $primaryKey = 'id';

    protected $fillable = [
        'constancia_cumplimiento_id',
        'proyecto_social_id'
    ];
}
