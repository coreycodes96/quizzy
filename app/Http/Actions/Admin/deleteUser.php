<?php

namespace App\Http\Actions\Admin;

use Exception;
use App\Models\User;

class deleteUser
{
    public function execute(int $id)
    {
        try
        {
            //Delete a user
            User::where('id', $id)
            ->delete();

            //Returning deleted user message
            return response()->json('User successfully deleted', 204);
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}