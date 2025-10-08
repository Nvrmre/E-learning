<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teachers';

    protected $fillable = [
        'id_user', 'email', 'nama_guru', 'password'
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function courses()
    {
        return $this->hasMany(Course::class, 'guru_id');
    }

}
