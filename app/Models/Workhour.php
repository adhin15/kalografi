<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workhour extends Model
{
    use HasFactory;
    protected $table = 'workhours';

    public function package()
    {
        return $this->hasMany(Package::class, 'photographer_id');
    }

    public function custom()
    {
        return $this->hasMany(Custom::class, 'photographer_id');
    }
}
