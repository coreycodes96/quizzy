<?php

namespace App\Http\Actions\Profile;

use Exception;
use App\Models\Supporter;

class Unsupport
{
    public function execute(int $id)
    {
        try
        {
            //Check if the sender is already supporting the user
            $isAlreadySupporter = Supporter::where([
                ['sender', auth()->user()->id],
                ['receiver', $id]
            ])
            ->count();

            //If the sender is already supporting the receiver
            if($isAlreadySupporter === 1)
            {
                //Support the receiver
                Supporter::where([
                    ['sender', auth()->user()->id],
                    ['receiver', $id]
                ])
                ->delete();

                //Returning the the new supporter
                return response()->json('You have successfully unsupported this user.', 204);
            }
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}