<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class custom extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'customs';

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'custom_id');
    }

    public function photographer()
    {
        return $this->belongsTo(photographers::class, 'photographer_id');
    }

    public function videographer()
    {
        return $this->belongsTo(videographers::class, 'videographer_id');
    }

    public function workhour()
    {
        return $this->belongsTo(workhours::class, 'workhour_id');
    }
}
