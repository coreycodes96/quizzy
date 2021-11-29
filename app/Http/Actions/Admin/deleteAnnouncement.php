<?php

namespace App\Http\Actions\Admin;

use Exception;
use App\Models\Announcement;

class deleteAnnouncement
{
    public function execute(int $id)
    {
        try
        {
            //Delete an announcement
            Announcement::where('id', $id)
            ->delete();

            //Returning the deleted announcement success message
            return response()->json('Announcement has been successfully deleted.', 204);
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}