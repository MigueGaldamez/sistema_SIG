<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $table = 'carreras_g';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_carrera',
        'codigo_carrera',
        'facultad_id',
    ];
    public function facultad()
    {
            return $this->belongsTo(Facultad::class, 'id');
    } 

}
