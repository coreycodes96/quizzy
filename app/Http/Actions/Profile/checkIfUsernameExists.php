<?php

namespace App\Http\Actions\Profile;

use Exception;
use App\Models\User;

class checkIfUsernameExists
{
    public function execute(string $username)
    {
        try
        {
            //Check username count
            $checkUsername = User::where('username', $username)
            ->count();
            
            //Returning username count
            return response()->json($checkUsername, 200);
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}