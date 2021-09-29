<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videographer extends Model
{
    use HasFactory;
    protected $table = 'videographers';

    public function package()
    {
        return $this->hasMany(Package::class, 'videographer_id');
    }

    public function custom()
    {
        return $this->hasMany(Custom::class, 'videographer_id');
    }
}
