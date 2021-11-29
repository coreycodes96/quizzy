<?php

namespace App\Http\Actions\Admin;

use Exception;
use App\Models\FAQ;
use Illuminate\Http\Request;

class createFAQ
{
    public function execute(Request $request)
    {
        //Create an FAQ validation
        $request->validate([
            'question' => ['required', 'max:140'],
            'answer' => ['required', 'max:500']
        ]);

        try
        {
            //Create FAQ
            $newFAQ = FAQ::create([
                'question' => $request->question,
                'answer' => $request->answer
            ]);

            //Returning the new FAQ
            return response()->json($newFAQ, 201);
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}