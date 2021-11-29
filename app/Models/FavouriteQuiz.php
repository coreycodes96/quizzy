<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteQuiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id'
    ];

    public function quizzes()
    {
        return $this->belongsTo(Quiz::class);
    }
}
