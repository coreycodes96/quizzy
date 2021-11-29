<?php

namespace App\Http\Controllers;

use App\Http\Actions\Announcement\Index;
use App\Http\Actions\Announcement\Show;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Index $actions)
    {
        return $actions->execute();
    }

    public function show(Show $actions)
    {
        return $actions->execute();
    }
}
