<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';
    protected $primaryKey='id';
    protected $fillable = [
        'assist_id',
        'atleta_id',
        'status'
    ];

    protected $guarded =[

    ];

    public function assist(): BelongsTo
    {
        return $this->belongsTo(Assist::class, 'assist_id', 'id');
    }

    public function atleta(): BelongsTo
    {
        return $this->belongsTo(Atleta::class, 'atleta_id', 'id');
    }
}
