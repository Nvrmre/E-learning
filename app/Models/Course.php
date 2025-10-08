<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_id',
        'kelas_id',
        'mapel',
        'materi_judul',
        'materi_text',
        'materi_file',
        'materi_tipe',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'guru_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'kelas_id');
    }


}
