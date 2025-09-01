<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BlongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Classs extends Model
{
    use HasFactory;
    protected $table = 'class';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable = [
        'name',
        'cycle_id',
        'category_id',
        'schedule_id',
        'instructor_id',
        'start_date',
        'end_date',
        'notes',
        'inscription_payment',
        'monthly_payment',
        'badge',
        'status',
        'mostrar'
    ];

    public function inscriptions(): HasMany
    {
        return $this->hasMany(Inscription::class);
    }

    public function cycle(): BelongsTo
    {
        return $this->belongsTo(Cycle::class, 'cycle_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class, 'schedule_id', 'id');
    }
}
