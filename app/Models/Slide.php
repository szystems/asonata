<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $table = 'slide';
    protected $fillable = [
        'titulo',
        'descripcion',
        'boton_texto',
        'boton_link',
        'imagen',
    ];
}
