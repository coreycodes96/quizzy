<?php

namespace App\Http\Actions\Quiz;

use Exception;
use App\Models\Quiz;
use Illuminate\Http\Request;

class Create
{
    public function execute(Request $request)
    {
        //Create a quiz validation
        $request->validate([
            'user_id' => ['required'],
            'title' => ['required', 'max:140'],
            'image' => ['required', 'mimes:jpg,jpeg,png'],
            'data' => ['required']
        ]);

        try
        {
            //Creating a quiz and storing it into the database
            $newQuiz = Quiz::create([
                'user_id' => $request->user_id,
                'title' => $request->title,
                'image' => $request->image->store('quizzes', 'public'),
                'data' => $request->data,
            ]);
            
            //Returning the new quiz
            return response()->json($newQuiz, 201);
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}