<?php

namespace App\Http\Actions\Quiz;

use Exception;

class Index
{
    public function execute()
    {
        try
        {
            //Returning quiz view
            return view('layouts.Quiz.quiz');
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}