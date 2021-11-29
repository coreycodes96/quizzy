<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/announcements';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:25'],
            'surname' => ['required', 'string', 'max:25'],
            'username' => ['required', 'unique:users', 'max:25'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'dob' => ['required'],
            'gender' => ['required'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'surname' => $data['surname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
        ]);
    }

    //Creating a user
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return $this->registered($request, $user);
    }

    //Checking if the username exists
    protected function checkIfUsernameExists(string $username)
    {
        $checkUsername = User::where('username', $username)
        ->count();

        return response()->json($checkUsername, 200);
    }

    //Checking if the email exists
    protected function checkIfEmailExists(string $email)
    {
        $checkEmail = User::where('email', $email)
        ->count();

        return response()->json($checkEmail, 200);
    }
}
