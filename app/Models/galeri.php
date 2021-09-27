<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class galeri extends Model
{
    use HasFactory;

    protected $table = 'galeris';
    protected $guarded = [];

    public function paket()
    {
        return $this->hasMany(Paket::class, 'idgaleri');
    }
}
