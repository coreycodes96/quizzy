<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/announcements';
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function login(Request $data)
    {
        //Validation
        $data->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:8', 'max:255']
        ]);

        //If the email does not exist
        if(User::where('email', $data['email'])->count() === 0)
        {
            return response()->json(['errors' => ['email' => ['The email you have entered does not exist']]], 422);
        }

        //Getting warnings
        $warnings = User::select('warnings')
        ->where('email', $data['email'])
        ->get();

        //Checking if the user is banned
        if($warnings[0]->warnings === 3)
        {
            return response()->json(['banned' => 'Your account has been banned!'], 405);
        }

        //attempting to log the user in
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']]))
        {
            $admin = User::select('is_admin')
            ->where('email', $data['email'])
            ->get();
            
            //if the data matches
            return response()->json($admin[0], 200);
        }else
        {
            //if the data does not match
            return response()->json('Incorrect Data', 422);
        }
    }
}
