<?php

namespace App\Http\Actions\Announcement;

use Exception;
use App\Models\Announcement;

class Show
{
    public function execute()
    {
        try
        {
            //Get all the announcements
            $announcements = Announcement::get();

            //Returning all the announcements
            return response()->json($announcements, 200);
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}