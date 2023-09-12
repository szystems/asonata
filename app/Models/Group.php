<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable = [
        'name',
        'description',
        'image',
        'status'
    ];

    protected $guarded =[

    ];
}