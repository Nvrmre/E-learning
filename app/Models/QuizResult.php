<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;
    protected $fillable = ['quiz_id', 'student_id', 'score', 'answers'];

    protected $casts = [
        'answers' => 'array',  // Menyimpan jawaban dalam format array
    ];

    // Relasi dengan Quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Relasi dengan User (siswa)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
