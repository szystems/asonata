<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atleta extends Model
{
    use HasFactory;
    protected $table = 'atleta';
    protected $primaryKey='id';
    protected $fillable = [
        'cui_dpi',
        'name',
        'image',
        'birth_certificate',
        'birth',
        'gender',
        'doses_number',
        'ethnic_group',
        'education_obtained',
        'tshirt_size',
        'phone',
        'whatsapp',
        'email',
        'vaccination_card',
        'address',
        'city',
        'state',
        'country',
        'status',
        'responsible_name',
        'responsible_dpi',
        'responsible_image',
        'responsible_phone',
        'responsible_whatsapp',
        'responsible_email',
        'responsible_address',
        'kinship',
        'responsible_doses_number',
    ];

    protected $guarded =[

    ];
}
