<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assist extends Model
{
    use HasFactory;


    protected $table = 'assists';
    protected $primaryKey='id';
    protected $fillable = [
        'class_id',
        'notes',
        'status'
    ];

    protected $guarded =[

    ];

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'class_id', 'id');
    }
}
