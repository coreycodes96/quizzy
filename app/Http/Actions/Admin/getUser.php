<?php

namespace App\Http\Actions\Admin;

use Exception;
use App\Models\User;

class getUser
{
    public function execute()
    {
        try
        {
            //Getting all the users
            $getUser = User::select('id', 'username')
            ->where('is_admin', '=', 0)
            ->get();

            //Returning the users
            return response()->json($getUser, 200);
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}