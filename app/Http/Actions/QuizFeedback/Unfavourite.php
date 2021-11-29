<?php

namespace App\Http\Actions\QuizFeedback;

use Exception;
use App\Models\FavouriteQuizFeedback;

class Unfavourite
{
    public function execute(int $id)
    {
        try
        {
            //Checking there is a quiz feedback favourite to delete
            $hasQuizFeedbackFavourite = FavouriteQuizFeedback::where('id', $id)
            ->count();

            //If there is a quiz feedback favourite
            if($hasQuizFeedbackFavourite === 1)
            {
                //Deleting the quiz feeback favourite
                FavouriteQuizFeedback::where('id', $id)
                ->delete();

                //Returning a message that the quiz feedback favourite has been deleted
                return response()->json('Quiz feedback favourite has been deleted', 204);
            }
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}