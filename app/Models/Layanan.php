<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';

    const UPDATED_AT = null;

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'harga',
        'estimasi_waktu',
        'gambar',
        'status',
    ];

    public function bookings()
    {
        return $this->hasMany(BookingServis::class, 'layanan_id');
    }
}
