<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasFactory;
    protected $table = 'instituciones_g';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_institucion',
        'contacto_institucion',
        'correo_institucion',
    ]; 
}
