<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $fillable = ['judul','deskripsi','file','classroom_id'];

    /**
     * Relasi ke Classroom (banyak modul dimiliki satu classroom)
     */
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
