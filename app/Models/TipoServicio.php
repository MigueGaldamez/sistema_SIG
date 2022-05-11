<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoServicio extends Model
{
    use HasFactory;
    protected $table = 'tipos_servicio_social_g';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_tipo_servicio',
    ]; 
}
