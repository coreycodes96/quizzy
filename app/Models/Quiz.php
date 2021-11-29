<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'image',
        'data',
    ];

    protected $cast = [
        'data' => 'array'
    ];

    public function quiz_favourites()
    {
        return $this->hasMany(FavouriteQuiz::class);
    }

    public function quiz_feedback()
    {
        return $this->hasMany(QuizFeedback::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}