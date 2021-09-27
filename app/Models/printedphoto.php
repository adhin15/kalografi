<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class printedphoto extends Model
{
    use HasFactory;
    protected $table = 'printedphotos';
    protected $guarded = [];

    public function booking()
    {
        return $this->hasMany(Booking::class, 'printedphoto_id');
    }
}
