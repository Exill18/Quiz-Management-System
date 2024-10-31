<?php

// app/Models/Exercise.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_id', 'question', 'solution', 'score'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
