<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ChangeUsernameTest extends TestCase
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

    public function test_change_username()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Getting user
        $user = $this->user();

        //Changed username
        $changedUsername = 'Test';

        //Creating a request to change the username
        $response = $this->json('PUT', '/profile/change/username/', [
            'new_username' => $changedUsername,
            'username' => $user->username,
        ]);

        //Checking if the username has been successfully changed
        $response->assertStatus(200);
    }
}