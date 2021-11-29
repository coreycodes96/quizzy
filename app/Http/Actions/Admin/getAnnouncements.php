<?php

namespace App\Http\Actions\Admin;

use Exception;
use App\Models\Announcement;

class getAnnouncements
{
    public function execute()
    {
        try
        {
            //Getting all the announcements
            $announcements = Announcement::get();

            //Returning the announcements
            return response()->json($announcements, 200);
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}