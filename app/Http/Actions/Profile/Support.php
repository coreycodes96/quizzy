<?php

namespace App\Http\Actions\Profile;

use Exception;
use App\Models\Supporter;
use Illuminate\Http\Request;

class Support
{
    public function execute(Request $request)
    {
        //Support validation
        $request->validate([
            'sender' => ['required'],
            'receiver' => ['required']
        ]);

        try
        {
            //Check if the sender is already supporting the user
            $isAlreadySupporter = Supporter::where([
                ['sender', $request->sender],
                ['receiver', $request->receiver]
            ])
            ->count();

            //If the sender is not already supporting the receiver
            if($isAlreadySupporter === 0)
            {
                //Support the receiver
                $newSupporter = Supporter::create([
                    'sender' => $request->sender,
                    'receiver' => $request->receiver
                ]);

                //Returning the the new supporter
                return response()->json($newSupporter, 201);
            }
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}