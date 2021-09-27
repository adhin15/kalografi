<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';
    protected $guarded = [];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'discount_id');
    }
}
