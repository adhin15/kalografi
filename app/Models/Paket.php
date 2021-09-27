<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'pakets';
    protected $guarded = [];

    public function booking()
    {
        return $this->hasMany(Booking::class, 'paket_id');
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

    public function galeris()
    {
        return $this->belongsTo(galeri::class, 'idgaleri');
    }
}
