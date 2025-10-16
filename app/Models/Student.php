<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';

    protected $fillable = [
        'id_user', 'nama_siswa', 'kelas_id', 'password'
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi dengan model Classroom
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'kelas_id');
    }
    public function scores()
    {
        return $this->hasMany(ExamScore::class);
    }
}
