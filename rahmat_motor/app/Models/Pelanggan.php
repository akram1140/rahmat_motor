<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    const UPDATED_AT = null;

    protected $fillable = [
        'nama',
        'no_hp',
        'alamat',
    ];

    public function bookings()
    {
        return $this->hasMany(BookingServis::class, 'pelanggan_id');
    }
}
