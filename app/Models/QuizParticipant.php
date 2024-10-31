<?php
// app/Models/QuizParticipant.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizParticipant extends Model
{
    protected $table = 'quiz_user'; // Specify the quiz_user table

    protected $fillable = ['quiz_id', 'user_id', 'username', 'score'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
