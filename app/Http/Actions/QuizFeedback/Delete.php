<?php

namespace App\Http\Actions\QuizFeedback;

use Exception;
use App\Models\QuizFeedback;

class Delete
{
    public function execute(int $id)
    {
        try
        {
            //Check if quiz feedback exists
            $hasQuizFeedback = QuizFeedback::where('id', $id)
            ->count();
            
            //If the quiz feedback exists
            if($hasQuizFeedback === 1)
            {
                //Deleting the quiz feedback
                QuizFeedback::where('id', $id)
                ->delete();

                //Returning a message that the quiz feedback has been successfully deleted
                return response()->json('Quiz feedback has been deleted', 204);
            }
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}