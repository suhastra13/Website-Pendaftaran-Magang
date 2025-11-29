<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran_magang', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('no_hp', 30);

            $table->string('universitas');
            $table->string('program_studi');
            $table->unsignedTinyInteger('semester')->nullable();

            $table->text('alamat')->nullable();

            $table->string('judul_magang')->nullable();
            $table->text('deskripsi_singkat')->nullable();

            $table->string('status', 20)->default('pending'); // pending, diterima, ditolak
            $table->text('catatan_admin')->nullable();

            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_magang');
    }
};
