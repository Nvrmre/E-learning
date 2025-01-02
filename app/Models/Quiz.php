<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    
    protected $fillable = ['title','questions','answers','created_at','updated_at'];

    // Relasi dengan pengguna (user)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
