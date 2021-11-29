<?php

namespace App\Http\Actions\Admin;

use Exception;
use App\Models\Announcement;
use Illuminate\Http\Request;

class createAnnouncement
{
    public function execute(Request $request)
    {
        //Create an announcement validation
        $request->validate([
            'title' => ['required', 'max:140'],
            'body' => ['required', 'max:700']
        ]);
        
        try
        {
            //Create announcement
            $newAnnouncement = Announcement::create([
                'title' => $request->title,
                'body' => $request->body
            ]);

            //Returning the new announcement
            return response()->json($newAnnouncement, 201);
        }catch(Exception $e)
        {
            throw new Exception($e->getMessage());
            //throw new Exception("Sorry an error has occurred");
        }
    }
}