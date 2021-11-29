<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Creating a user
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => 'Doe',
            'username' => 'JohnDoe',
            'email' => 'johndoe@test.com',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        //Checking the user has been created
        $response->assertStatus(201);

        //Checking the user is in the database
        $this->assertCount(1, User::get());

        //logging in the user
        $response = $this->json('POST', '/login', [
            'email' => 'johndoe@test.com',
            'password' => 'password1234',
        ]);

        //Redirecting to the announcements route
        $response->assertRedirect('/announcements');
    }
}
