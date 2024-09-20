<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    protected $table = "lapangan_tables";
    protected $fillable = [
        'id',
        'deskripsi',
        'harga',
        'image'
    ];
}
