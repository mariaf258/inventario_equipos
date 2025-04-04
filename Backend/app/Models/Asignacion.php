<?php
namespace App\Models;

use App\Http\Controllers\EquiposController;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $table = 'asignaciones';    
    protected $fillable = ['equipo_id', 'usuario', 'fecha'];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}