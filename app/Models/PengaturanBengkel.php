<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanBengkel extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_bengkel';

    public $timestamps = false;

    protected $fillable = [
        'nama_bengkel',
        'alamat',
        'no_hp',
        'whatsapp',
        'email',
        'jam_buka',
        'jam_tutup',
        'deskripsi',
        'maps_url',
        'logo',
    ];
}
