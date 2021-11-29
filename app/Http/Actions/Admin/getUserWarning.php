<?php

namespace App\Http\Actions\Admin;

use Exception;
use App\Models\User;

class getUserWarning
{
    public function execute()
    {
        try
        {
            //Get users
            $users = User::select('id', 'username', 'warnings')
            ->where([
                ['warnings', '!=', 3],
                ['is_admin', '=', 0]
            ])
            ->get();

            //Return users
            return response()->json($users, 200);
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}