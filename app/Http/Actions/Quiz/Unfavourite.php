<?php

namespace App\Http\Actions\Quiz;

use Exception;
use App\Models\FavouriteQuiz;
use Illuminate\Http\Request;

class Unfavourite
{
    public function execute(int $id)
    {
        try
        {
            //Checking if the user has already liked the quiz
            $hasFavourite = FavouriteQuiz::where([
                ['user_id', auth()->user()->id],
                ['quiz_id', $id],
            ])
            ->count();

            //If the user has liked the quiz
            if($hasFavourite === 1)
            {
                //Delete the favourite
                FavouriteQuiz::where('quiz_id', $id)
                ->delete();

                //Return a success message to say the favourite has been deleted
                return response()->json('Favourite successfully deleted!', 204);
            }
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}