<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // ID utama untuk setiap entri
            $table->foreignId('kelas_id')->constrained('classrooms'); // Relasi ke tabel 'classrooms'
            $table->foreignId('guru_id')->constrained('teachers'); // Relasi ke tabel 'teachers'
            $table->string('mapel'); // Nama mata pelajaran
            $table->string('materi_judul'); // Judul materi
            $table->text('materi_text')->nullable(); // Konten materi jika diinput manual
            $table->string('materi_file')->nullable(); // Nama file materi jika diupload
            $table->enum('materi_tipe', ['pdf', 'text'])->default('text'); // Tipe materi (pdf atau teks)
            $table->timestamps(); // Timestamp untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
