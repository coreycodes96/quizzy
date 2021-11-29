<?php

namespace App\Http\Actions\Quiz;

use Exception;
use App\Models\Quiz;

class Show
{
    public function execute()
    {
        try
        {
            //Getting the quizzes
            $quizzes = Quiz::with('quiz_favourites')
            ->withCount('quiz_feedback')
            ->latest()
            ->get();

            //Returning the quizzes
            return response()->json($quizzes, 200);
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}