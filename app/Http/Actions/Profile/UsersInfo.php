<?php

namespace App\Http\Actions\Profile;

use Exception;
use App\Models\User;


class UsersInfo
{
    public function execute(string $username){
        try
        {
            //Check if user exists
            $doesUserExist = User::where('username', $username)
            ->count();

            //If the user exists
            if($doesUserExist === 1)
            {
                //Users info
                $info = User::with('quizzes', 'supporters')
                ->get();

                //Returning the users info
                return response()->json($info, 200);
            }else
            {
                //If the user does not exist
                return response()->json('Sorry user has not been found', 404);
            }
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}