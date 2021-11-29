<?php

namespace App\Http\Actions\FAQ;

use Exception;

class Index
{
    public function execute()
    {
        try
        {
            //Returning view
            return view('layouts.Faq.faq');
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}