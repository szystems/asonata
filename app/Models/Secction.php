<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secction extends Model
{
    use HasFactory;
    protected $table = 'sections';
    protected $fillable = [
        'inicio_titulo',
        'inicio_descripcion',
        'inicio_descripcion_2',
        'video_fondo',
        'video_link',
        'video_titulo',
        'video_descripcion',
        'nosotros_imagen',
        'nosotros_titulo',
        'nosotros_descripcion',
        'nosotros_descripcion2',
        'contacto_titulo',
        'contacto_descripcion',
        'contacto_titulo2',
        'contacto_descripcion2',
        'contacto_direccion',
        'contacto_telefono',
        'contacto_telefono2',
        'contacto_email',
        'contacto_lunes_viernes',
        'contacto_lunes_viernes2',
        'contacto_domingo',
    ];
}
