<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    use HasFactory;
    protected $table = 'facultades_g';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_facultad',
    ];
    public function carreras()
    {
            return $this->hasMany(Carrera::class, 'id');
    } 
}
