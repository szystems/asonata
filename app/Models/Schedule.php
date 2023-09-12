<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedule';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable = [
        'cycle_id',
        'facility_id',
        'start_time',
        'end_time',
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'quota',
        'status'
    ];

    protected $guarded =[

    ];

    public function cycle()
    {
        return $this->belongsTo(Cycle::class, 'cycle_id', 'id');
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }
}
