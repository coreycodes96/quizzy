<?php

namespace App\Http\Actions\Admin;

use Exception;
use App\Models\FAQ;

class getFAQs
{
    public function execute()
    {
        try
        {
            //Getting all the FAQs
            $getFAQs = FAQ::get();

            //Returning the FAQs
            return response()->json($getFAQs, 200);
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}