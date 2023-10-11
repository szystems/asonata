<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable = [
        'group_id',
        'name',
        'age_from',
        'age_to',
        'requirements',
        'implements',
        'description',
        'image',
        'contract',
        'status'
    ];

    protected $guarded =[

    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function classes(): HasMany
    {
        return $this->hasMany(Classs::class, 'category_id');
    }
}
