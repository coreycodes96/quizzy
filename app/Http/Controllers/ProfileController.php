<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Actions\Profile\Index;
use App\Http\Actions\Profile\Support;
use App\Http\Actions\Profile\UsersInfo;
use App\Http\Actions\Profile\Unsupport;
use App\Http\Actions\Profile\ChangeUsername;
use App\Http\Actions\Profile\ChangePassword;
use App\Http\Actions\Profile\checkIfUsernameExists;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(string $username, Index $actions)
    {
        return $actions->execute($username);
    }

    public function usersInfo(string $username, UsersInfo $actions)
    {
        return $actions->execute($username);
    }

    protected function support(Request $request, Support $actions)
    {
        return $actions->execute($request);
    }

    protected function unsupport(int $id, Unsupport $actions)
    {
        return $actions->execute($id);
    }

    protected function changeUsername(Request $request, ChangeUsername $actions)
    {
        return $actions->execute($request);
    }

    public function checkIfUsernameExists(string $username, checkIfUsernameExists $actions)
    {
        return $actions->execute($username);
    }

    protected function changePassword(Request $request, ChangePassword $actions)
    {
        return $actions->execute($request);
    }
}