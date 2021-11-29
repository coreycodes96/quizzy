<?php

namespace App\Http\Actions\Profile;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangeUsername
{
    public function execute(Request $request)
    {
        //Change username validation
        $request->validate([
            'new_username' => ['required', 'max:25'],
            'username' => ['required'],
        ]);

        try
        {
            //Checking if the username already exists
            $doesUsernameExist = User::where('username', $request->username)
            ->count();

            if($doesUsernameExist === 1)
            {
                //Changing the users username
                User::where('username', $request->username)
                ->update(
                    ['username' => $request->new_username]
                );

                //Log the user out
                Auth::logout();

                //Returning a message that the username has been changed
                return response()->json('Username has been successfuly changed', 200);
            }
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}