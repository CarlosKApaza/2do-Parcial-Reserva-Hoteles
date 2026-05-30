<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;

    protected $table = 'habitacions';
    protected $primaryKey = 'codHabitacion';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'codHabitacion',
        'tipo',
        'capacidad',
        'tarifa',
        'disponible'
    ];
}
