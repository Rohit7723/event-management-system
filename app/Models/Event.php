<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Participant;
class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'event_date',
        'location',
        'max_seats',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function participants()
{
    return $this->hasMany(Participant::class);
}
}