<?php

namespace App\Http\Actions\FAQ;

use Exception;
use App\Models\FAQ;

class Show
{
    public function execute()
    {
        try
        {
            //Get all the FAQs
            $faqs = FAQ::get();

            //Returning all the FAQs
            return response()->json($faqs, 200);
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}