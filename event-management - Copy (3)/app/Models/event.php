<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'user_id',  // this should be the creator's user ID
    ];

    // Cast dates to Carbon instances for easy date formatting
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship for the user who created the event
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
