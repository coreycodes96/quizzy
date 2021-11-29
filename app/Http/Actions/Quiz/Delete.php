<?php

namespace App\Http\Actions\Quiz;

use Exception;
use App\Models\Quiz;
use Illuminate\Support\Facades\Storage;

class Delete
{
    public function execute(int $id)
    {
        try
        {
            //Checking if the quiz exists
            $quiz = Quiz::where('id', $id)
            ->first();

            //Checking if the quiz exists
            if($quiz)
            {
                //Delete the quiz
                Quiz::where('id', $quiz->id)
                ->delete();

                //Delete the image
                Storage::disk('public')->delete($quiz->image);

                //Return quiz deleted success message
                return response()->json('Quiz successfully deleted!', 204);
            }
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}