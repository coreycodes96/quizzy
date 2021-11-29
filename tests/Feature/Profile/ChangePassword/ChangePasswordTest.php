<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    public function user()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Get a user
        $user = User::factory()->create();

        //Logging a user in
        $this->actingAs($user);

        //Checking if the user is successfully logged in
        $this->assertTrue(Auth::check());

        return $user;
    }

    public function test_change_password()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Getting user
        $user = $this->user();

        //Changed password
        $changedPassword = 'test1234';

        //Creating a request to change the password
        $response = $this->json('PUT', '/profile/change/password/', [
            'new_password' => $changedPassword,
            'current_password' => $user->password,
        ]);

        //Checking if the password has been successfully changed
        $response->assertStatus(200);
    }
}