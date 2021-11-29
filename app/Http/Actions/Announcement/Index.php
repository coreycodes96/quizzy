<?php

namespace App\Http\Actions\Announcement;

use Exception;

class Index
{
    public function execute()
    {
        try
        {
            //Returning view
            return view('layouts.Announcement.announcement');
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}