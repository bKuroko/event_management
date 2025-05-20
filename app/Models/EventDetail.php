<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'category',
        'staff_id',
        'supplier_id',
        'created_by',
        'status',
        'attendees'
    ];

    protected $casts = [
        'date' => 'datetime',
        'attendees' => 'array', // This ensures JSON is cast to array
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'event_staff', 'event_detail_id', 'staff_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
