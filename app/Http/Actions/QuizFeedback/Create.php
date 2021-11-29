<?php

namespace App\Http\Actions\QuizFeedback;

use Exception;
use App\Models\QuizFeedback;
use Illuminate\Http\Request;

class Create
{
    public function execute(Request $request)
    {
        //Quiz feedback validation
        $request->validate([
            'user_id' => ['required'],
            'quiz_id' => ['required'],
            'body' => ['required', 'max:2000']
        ]);

        try
        {
            //Create feedback to a quiz
            $newQuizFeedback = QuizFeedback::create([
                'user_id' => $request->user_id,
                'quiz_id' => $request->quiz_id,
                'body' => $request->body
            ]);

            //Return the created quiz feedback
            return response()->json($newQuizFeedback, 201);
        }catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }
}