<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'customs';

    public function booking()
    {
        return $this->hasMany(Booking::class, 'custom_id');
    }

    public function photographer()
    {
        return $this->belongsTo(Photographer::class, 'photographer_id');
    }

    public function videographer()
    {
        return $this->belongsTo(Videographer::class, 'videographer_id');
    }

    public function workhour()
    {
        return $this->belongsTo(Workhour::class, 'workhour_id');
    }
}
