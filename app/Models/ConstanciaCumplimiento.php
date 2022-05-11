<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstanciaCumplimiento extends Model
{
    use HasFactory;
    protected $table = 'constancias_cumplimiento_g';
    protected $primaryKey = 'id';

    protected $fillable = [
        'estudiante_id',
    ];
}
