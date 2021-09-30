<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workhour extends Model
{
    use HasFactory;
    protected $table = 'workhours';
    protected $guarded = [];

    public function package()
    {
        return $this->hasMany(Package::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'workhours_id');
    }
}
