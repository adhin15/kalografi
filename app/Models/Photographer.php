<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photographer extends Model
{
    use HasFactory;
    protected $table = 'photographers';

    public function package()
    {
        return $this->hasMany(Package::class);
    }

    public function custom()
    {
        return $this->hasMany(Custom::class, 'photographer_id');
    }
}
