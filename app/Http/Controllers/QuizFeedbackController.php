<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Actions\QuizFeedback\Show;
use App\Http\Actions\QuizFeedback\Create;
use App\Http\Actions\QuizFeedback\Delete;
use App\Http\Actions\QuizFeedback\Favourite;
use App\Http\Actions\QuizFeedback\Unfavourite;

class QuizFeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(int $id, Show $action)
    {
        return $action->execute($id);
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
