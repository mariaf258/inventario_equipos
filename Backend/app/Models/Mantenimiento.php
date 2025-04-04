<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipo_id',
        'descripcion',
        'fecha',
        'tecnico',
    ];

    /**
     * Relación: Un mantenimiento pertenece a un equipo
     */
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}