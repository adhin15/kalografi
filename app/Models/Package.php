<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages';
    protected $guarded = [];

    public function booking()
    {
        return $this->hasMany(Booking::class, 'package_id');
    }

    public function photographer()
    {
        return $this->belongsTo(Photographer::class);
    }

    public function videographer()
    {
        return $this->belongsTo(Videographer::class, 'videographer_id');
    }

    public function workhour()
    {
        return $this->belongsTo(Workhour::class, 'workhour_id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
