<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarBooking extends Model
{
    protected $table = "booking_tables";
    protected $fillable = [
        'id',
        'invoice',
        'nama',
        'no_lapang',
        'total_jam',
        'total_harga',
        'status',
        'jadwal_array',
        'booked'
    ];
}
