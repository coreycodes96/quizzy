<?php

namespace App\Http\Actions\Admin;

use App\Models\User;
use Exception;

class Index
{
    public function execute()
    {
        try{
            return view('layouts.Admin.admin');
        }catch(Exception $e){
            throw new Exception("Sorry an error has occurred");
        }
    }
}