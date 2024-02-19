<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Club extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'country',
        'owner',
        'email',
        'phone',
        'website',
        'club_idpa_id',
        'logo',
    ];

    public function competitions(): HasMany
    {
        return $this->hasMany(Competition::class);
    }
}
