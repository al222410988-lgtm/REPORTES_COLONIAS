<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActualizacionPerfil extends Model
{
    use HasFactory;

    protected $table = 'actualizaciones_perfil';

    protected $fillable = [
        'user_id',
        'campo_actualizado',
        'fecha_actualizacion',
    ];

    protected $casts = [
        'fecha_actualizacion' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(Usuario::class);
    }
}
