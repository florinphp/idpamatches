<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Competition extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'club_id',
        'location',
        'country',
        'level',
        'start_date',
        'end_date',
        'stages',
        'rounds',
        'shooters',
        'price',
        'currency',
        'registration_link',
        'registration_start_date',
        'result_link',
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }
}
