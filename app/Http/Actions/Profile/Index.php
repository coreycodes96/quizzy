<?php

namespace App\Http\Actions\Profile;

use Exception;
use App\Models\User;

class Index
{
    public function execute(string $username)
    {
        try
        {
            //Check if the user exists
            $doesUserExist = User::where('username', $username)
            ->select('id', 'username')
            ->get();

            if(count($doesUserExist) === 1)
            {
                //User id
                $id = $doesUserExist[0]['id'];

                //If the username is found
                return view('layouts.Profile.profile', compact('id', 'username'));
            }else
            {
                //If the username is not found 
                return response()->json('Sorry username does not exist', 404);
            }
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}