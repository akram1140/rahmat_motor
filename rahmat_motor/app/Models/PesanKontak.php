<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanKontak extends Model
{
    use HasFactory;

    protected $table = 'pesan_kontak';

    const UPDATED_AT = null;

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'subjek',
        'pesan',
        'status',
    ];
}
