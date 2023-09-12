<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inscription;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable = [
        'name',
        'inscription_id',
        'type',
        'paid'
    ];

    public function inscription(): BelongsTo
    {
        return $this->belongsTo(Inscription::class);
    }
}
