<?php

namespace App\Http\Controllers;

use App\Http\Actions\Admin\Index;
use App\Http\Actions\Admin\getUserWarning;
use App\Http\Actions\Admin\updateUserWarning;
use App\Http\Actions\Admin\getUser;
use App\Http\Actions\Admin\deleteUser;
use App\Http\Actions\Admin\getAnnouncements;
use App\Http\Actions\Admin\createAnnouncement;
use App\Http\Actions\Admin\deleteAnnouncement;
use App\Http\Actions\Admin\getFAQs;
use App\Http\Actions\Admin\createFAQ;
use App\Http\Actions\Admin\deleteFAQ;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Index $actions)
    {
        return $actions->execute();
    }

    public function getUserWarning(getUserWarning $actions)
    {
        return $actions->execute();
    }

    protected function updateUserWarning(Request $request, updateUserWarning $actions)
    {
        return $actions->execute($request);
    }

    protected function getUser(getUser $actions)
    {
        return $actions->execute();
    }

    protected function deleteUser(int $id, deleteUser $actions)
    {
        return $actions->execute($id);
    }

    protected function getAnnouncements(getAnnouncements $actions)
    {
        return $actions->execute();
    }

    protected function createAnnouncement(Request $request, createAnnouncement $actions)
    {
        return $actions->execute($request);
    }

    protected function deleteAnnouncement(int $id, deleteAnnouncement $actions)
    {
        return $actions->execute($id);
    }

    protected function getFAQs(getFAQs $actions)
    {
        return $actions->execute();
    }

    protected function createFAQ(Request $request, createFAQ $actions)
    {
        return $actions->execute($request);
    }

    protected function deleteFAQ(int $id, deleteFAQ $actions)
    {
        return $actions->execute($id);
    }
}