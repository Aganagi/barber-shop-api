<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'time'
    ];

    public function users():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
