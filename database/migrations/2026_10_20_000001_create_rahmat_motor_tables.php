<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('pelanggan')) {
            Schema::create('pelanggan', function (Blueprint $table) {
                $table->id();
                $table->string('nama', 100);
                $table->string('no_hp', 20);
                $table->text('alamat')->nullable();
                $table->timestamp('created_at')->useCurrent();
            });
        }

        if (!Schema::hasTable('layanan')) {
            Schema::create('layanan', function (Blueprint $table) {
                $table->id();
                $table->string('nama_layanan', 150);
                $table->text('deskripsi')->nullable();
                $table->decimal('harga', 12, 2)->default(0);
                $table->string('estimasi_waktu', 50)->nullable();
                $table->string('gambar', 255)->nullable();
                $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
                $table->timestamp('created_at')->useCurrent();
            });
        }

        if (!Schema::hasTable('galeri')) {
            Schema::create('galeri', function (Blueprint $table) {
                $table->id();
                $table->string('judul', 150);
                $table->text('deskripsi')->nullable();
                $table->string('gambar', 255);
                $table->enum('kategori', ['bengkel', 'servis', 'mekanik', 'hasil_kerja', 'lainnya'])->default('lainnya');
                $table->timestamp('created_at')->useCurrent();
            });
        }

        if (!Schema::hasTable('booking_servis')) {
            Schema::create('booking_servis', function (Blueprint $table) {
                $table->id();
                $table->foreignId('pelanggan_id')->constrained('pelanggan')->cascadeOnDelete()->cascadeOnUpdate();
                $table->foreignId('layanan_id')->constrained('layanan')->cascadeOnDelete()->cascadeOnUpdate();
                $table->date('tanggal_booking');
                $table->time('jam_booking');
                $table->text('keluhan')->nullable();
                $table->enum('status', ['Menunggu', 'Dikonfirmasi', 'Diproses', 'Selesai', 'Dibatalkan', 'Ditolak'])->default('Menunggu');
                $table->text('catatan_admin')->nullable();
                $table->timestamp('created_at')->useCurrent();
            });
        }

        if (!Schema::hasTable('pesan_kontak')) {
            Schema::create('pesan_kontak', function (Blueprint $table) {
                $table->id();
                $table->string('nama', 100);
                $table->string('email', 100)->nullable();
                $table->string('no_hp', 20)->nullable();
                $table->string('subjek', 200)->nullable();
                $table->text('pesan');
                $table->enum('status', ['Belum Dibaca', 'Sudah Dibaca'])->default('Belum Dibaca');
                $table->timestamp('created_at')->useCurrent();
            });
        }

        if (!Schema::hasTable('pengaturan_bengkel')) {
            Schema::create('pengaturan_bengkel', function (Blueprint $table) {
                $table->id();
                $table->string('nama_bengkel', 100);
                $table->text('alamat')->nullable();
                $table->string('no_hp', 20)->nullable();
                $table->string('whatsapp', 20)->nullable();
                $table->string('email', 100)->nullable();
                $table->string('jam_buka', 20)->default('08.00');
                $table->string('jam_tutup', 20)->default('17.00');
                $table->text('deskripsi')->nullable();
                $table->text('maps_url')->nullable();
                $table->string('logo', 255)->nullable();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('booking_servis');
        Schema::dropIfExists('pesan_kontak');
        Schema::dropIfExists('pengaturan_bengkel');
        Schema::dropIfExists('galeri');
        Schema::dropIfExists('layanan');
        Schema::dropIfExists('pelanggan');
    }
};
