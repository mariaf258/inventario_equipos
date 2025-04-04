<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipo_id',
        'accion',
        'fecha',
    ];

    /**
     * Relación: Un histórico pertenece a un equipo
     */
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}