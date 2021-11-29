<?php

namespace App\Http\Actions\Profile;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassword
{
    public function execute(Request $request)
    {
        //Change password validation
        $request->validate([
            'current_password' => ['required', 'min:8', 'max:255'],
            'new_password' => ['required', 'min:8', 'max:255'],
        ]);

        try
        {
            //Checking if the user exists
            $user = User::where('id', auth()->user()->id)
            ->first();

            //Checking if the current password is correct
            $isPasswordCorrect = password_verify($request->current_password, $user->password);

            //If the current password is correct
            if($isPasswordCorrect)
            {
                //Change the password
                User::where('id', $user->id)
                ->update(['password' => Hash::make($request->new_password)]);

                //Log the user out
                Auth::logout();

                //Returning a message that the users password has been changed
                return response()->json('Your password has been successfully changed', 200);
            }
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}