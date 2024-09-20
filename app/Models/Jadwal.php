<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = "jadwal_tables";
    protected $fillable = [
        'id',
        'jadwal',
        'is_active'
    ];
}
