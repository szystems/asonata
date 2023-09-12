<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inscription extends Model
{
    use HasFactory;
    protected $table = 'inscriptions';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable = [
        'class_id',
        'cycle_id',
        'atleta_id',
        'inscription_number',
        'contract',
        'inscription_payment',
        'badge_payment',
        'payments',
        'notes',
        'inscription_status',
        'status'
    ];

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(Classs::class);
    }

    public function cycle(): BelongsTo
    {
        return $this->belongsTo(Cycle::class);
    }

    public function atleta(): BelongsTo
    {
        return $this->belongsTo(Atleta::class, 'atleta_id', 'id');
    }

    protected $guarded =[

    ];
}
