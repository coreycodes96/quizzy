<?php

namespace App\Http\Actions\Admin;

use Exception;
use App\Models\FAQ;

class deleteFAQ
{
    public function execute(int $id)
    {
        try
        {
            //Delete an FAQ
            FAQ::where('id', $id)
            ->delete();

            //Returning the deleted FAQ success message
            return response()->json('FAQ has been successfully deleted.', 204);
        }catch(Exception $e)
        {
            throw new Exception("Sorry an error has occurred");
        }
    }
}