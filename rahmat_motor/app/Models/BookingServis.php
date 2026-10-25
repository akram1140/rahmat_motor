<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingServis extends Model
{
    use HasFactory;

    protected $table = 'booking_servis';

    const UPDATED_AT = null;

    protected $fillable = [
        'pelanggan_id',
        'layanan_id',
        'tanggal_booking',
        'jam_booking',
        'keluhan',
        'status',
        'catatan_admin',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }

    public function getFormattedIdAttribute()
    {
        return '#' . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }
}
