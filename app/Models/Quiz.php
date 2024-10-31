<?php

// app/Models/Quiz.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id'];

    public function user() // Creator of the quiz
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'quiz_tag');
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function participants()
    {
        return $this->hasMany(QuizParticipant::class);
    }

    protected static function booted()
    {
        static::creating(function ($quiz) {
            $quiz->slug = Str::slug($quiz->title . '-' . Str::random(5)); // Generates a unique slug
        });
    }

    
}
