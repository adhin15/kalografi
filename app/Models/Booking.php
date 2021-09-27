<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $guarded = [];

    //MIDTRANS PAYMENT VARIABLES
    public const PAYMENT_CHANNELS = [
        "credit_card",
        "cimb_clicks",
        "bca_klikbca",
        "bca_klikpay",
        "bri_epay",
        "echannel",
        "bca_va",
        "bri_va",
        "other_va",
        "indomaret",
        "danamon_online",
    ];
    public const EXPIRY_DURATION = 3;
    public const EXPIRY_UNIT = 'days';

    public const CHALLENGE = 'challenge';
    public const SUCCESS = 'success';
    public const SETTLEMENT = 'settlement';
    public const PENDING = 'pending';
    public const DENY = 'deny';
    public const EXPIRE = 'expire';
    public const CANCEL = 'cancel';

    public const PAYMENT_CODE = 'PAY';


    public function pakets()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }

    public function custom()
    {
        return $this->belongsTo(custom::class, 'custom_id');
    }

    public function discount()
    {
        return $this->belongsTo(discount::class, 'discount_id');
    }

    public function printedphotos()
    {
        return $this->belongsTo(printedphoto::class, 'printedphoto_id');
    }

    public function photobooks()
    {
        return $this->belongsTo(photobook::class, 'photobook_id');
    }

    public function status()
    {
        return $this->hasMany(status::class, 'booking_id');
    }
}
