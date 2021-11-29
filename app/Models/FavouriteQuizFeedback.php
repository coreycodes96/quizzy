<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteQuizFeedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_feedback_id',
    ];

    public function quiz_feedback()
    {
        return $this->belongsTo(QuizFeedback::class);
    }
}
