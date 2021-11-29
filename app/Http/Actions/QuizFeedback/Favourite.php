<?php

namespace App\Http\Actions\QuizFeedback;

use Exception;
use App\Models\FavouriteQuizFeedback;
use Illuminate\Http\Request;

class Favourite
{
    public function execute(Request $request)
    {
        //Validation
        $request->validate([
            'user_id' => ['required'],
            'quiz_feedback_id' => ['required'],
        ]);

        try
        {
            //Creating feeback favourite
            $newQuizFeedbackFavourite = FavouriteQuizFeedback::create([
                'user_id' => $request->user_id,
                'quiz_feedback_id' => $request->quiz_feedback_id,
            ]);

            //Returning the new favourite
            return response()->json($newQuizFeedbackFavourite, 201);
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}