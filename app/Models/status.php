<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'status';
    public function booking()
    {
        return $this->hasMany(Booking::class, 'booking_id');
    }
}
