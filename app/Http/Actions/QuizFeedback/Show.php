<?php

namespace App\Http\Actions\QuizFeedback;

use Exception;
use App\Models\QuizFeedback;

class Show
{
    public function execute(int $id)
    {
        try
        {
            //Getting quiz feeback
            $quiz_feedback = QuizFeedback::where('quiz_id', $id)
            ->with('quiz_feedback_favourites')
            ->latest()
            ->get();

            //Returning the quiz feedback
            return response()->json($quiz_feedback, 200);
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}