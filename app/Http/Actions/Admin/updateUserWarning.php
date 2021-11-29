<?php

namespace App\Http\Actions\Admin;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;

class updateUserWarning
{
    public function execute(Request $request)
    {
        //Update user warning validation
        $request->validate([
            'id' => ['required'],
            'warnings' => ['required']
        ]);
        
        try
        {
            //Warning count
            $count = 0;

            //Users first warning
            if($request->warnings === 0)
            {
                $count = $request->warnings + 1;
            }

            //Users second warning
            if($request->warnings === 1)
            {
                $count = $request->warnings + 1;
            }

            //Users third warning (banning the user)
            if($request->warnings === 2)
            {
                $count = $request->warnings + 1;
            }

            //Update user warning
            User::where('id', $request->id)
            ->update(['warnings' => $count]);

            //Returning success message
            return response()->json('Warning has been successfully updated', 200);

        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}