<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizFeedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'body',
    ];

    public function quiz_feedback_favourites()
    {
        return $this->hasMany(FavouriteQuizFeedback::class);
    }

    public function quizzes()
    {
        return $this->belongsTo(Quiz::class);
    }
}
