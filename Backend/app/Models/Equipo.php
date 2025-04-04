<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'equipo_id',
        'fecha_asignacion',
        'fecha_devolucion',
    ];

    /**
     * Relación: Una asignación pertenece a un usuario
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación: Una asignación pertenece a un equipo
     */
    // public function equipo()
    // {
    //     return $this->belongsTo(Equipo::class);
    // }
}