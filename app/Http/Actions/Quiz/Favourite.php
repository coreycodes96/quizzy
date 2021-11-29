<?php

namespace App\Http\Actions\Quiz;

use Exception;
use Illuminate\Http\Request;
use App\Models\FavouriteQuiz;

class Favourite
{
    public function execute(Request $request)
    {
        //Favourite validation
        $request->validate([
            'user_id' => ['required'],
            'quiz_id' => ['required']
        ]);

        try
        {
            //Check if the user has already favourited the quiz
            $hasFavourited = FavouriteQuiz::where([
                ['user_id', $request->user_id ],
                ['quiz_id', $request->quiz_id]
            ])->count();
            
            //If the user has not favourited the quiz
            if($hasFavourited === 0)
            {
                //Creating a favourite
                $favouriteQuiz = FavouriteQuiz::create([
                    'user_id' => $request->user_id,
                    'quiz_id' => $request->quiz_id,
                ]);

                //Returning the favourite
                return response()->json($favouriteQuiz, 201);
            }
        }catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }
}