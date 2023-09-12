<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    use HasFactory;
    protected $table = 'cycles';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status'
    ];

    protected $guarded =[

    ];
}
