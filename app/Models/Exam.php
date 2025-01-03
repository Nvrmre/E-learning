<?php

// Model Exam
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['exam_name', 'exam_date', 'classroom_id'];

    // In Exam.php model
    public function examScores()
    {
        return $this->hasMany(ExamScore::class);
    }


    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
