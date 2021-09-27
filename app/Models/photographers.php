<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class photographers extends Model
{
    use HasFactory;
    protected $table = 'photographers';

    public function paket()
    {
        return $this->hasMany(Paket::class, 'photographer_id');
    }

    public function custom()
    {
        return $this->hasMany(custom::class, 'photographer_id');
    }
}
