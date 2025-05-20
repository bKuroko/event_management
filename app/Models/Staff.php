<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    public function events()
{
    return $this->belongsToMany(EventDetail::class, 'event_staff', 'staff_id', 'event_detail_id');
}

}
