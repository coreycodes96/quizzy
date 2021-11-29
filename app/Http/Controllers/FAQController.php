<?php

namespace App\Http\Controllers;

use App\Http\Actions\FAQ\Index;
use App\Http\Actions\FAQ\Show;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index(Index $actions)
    {
        return $actions->execute();
    }

    public function show(Show $actions)
    {
        return $actions->execute();
    }
}
