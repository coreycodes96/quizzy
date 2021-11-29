<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Actions\Quiz\Index;
use App\Http\Actions\Quiz\Show;
use App\Http\Actions\Quiz\Create;
use App\Http\Actions\Quiz\Delete;
use App\Http\Actions\Quiz\Favourite;
use App\Http\Actions\Quiz\Unfavourite;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Index $action)
    {
        return $action->execute();
    }

    public function show(Show $action)
    {
        return $action->execute();
    }

    protected function create(Request $request, Create $action)
    {
        return $action->execute($request);
    }

    protected function delete(int $id, Delete $action)
    {
        return $action->execute($id);
    }

    protected function favourite(Request $request, Favourite $action)
    {
        return $action->execute($request);
    }

    protected function unfavourite(int $id, Unfavourite $action)
    {
        return $action->execute($id);
    }
}
