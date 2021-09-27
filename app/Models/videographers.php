<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class videographers extends Model
{
    use HasFactory;
    protected $table = 'videographers';

    public function paket()
    {
        return $this->hasMany(Paket::class, 'videographer_id');
    }

    public function custom()
    {
        return $this->hasMany(custom::class, 'videographer_id');
    }
}
