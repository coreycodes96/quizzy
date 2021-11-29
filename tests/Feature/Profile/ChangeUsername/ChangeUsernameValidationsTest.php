<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ChangeUsernameValidationsTest extends TestCase
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

    public function test_change_username_the_new_username_is_required()
    {
        //Getting user
        $user = $this->user();

        //Changed username
        $changedUsername = 'Test';

        //Creating a request to change the username
        $response = $this->json('PUT', '/profile/change/username/', [
            'username' => $user->username,
            'new_username' => ''
        ]);

        //Getting the new username error
        $response->assertJsonValidationErrors('new_username');
    }

    public function test_change_username_the_new_username_max()
    {
        //Getting user
        $user = $this->user();

        //Changed username
        $changedUsername = 'TestTestTestTestTestTestTestTestTest';

        //Creating a request to change the username
        $response = $this->json('PUT', '/profile/change/username/', [
            'username' => $user->username,
            'new_username' => $changedUsername
        ]);

        //Getting the new username error
        $response->assertJsonValidationErrors('new_username');
    }

    public function test_change_username_the_username_is_required()
    {
        //Getting users
        $user1 = $this->user();

        //Changed username
        $changedUsername = 'Test';

        //Creating a request to change the username
        $response = $this->json('PUT', '/profile/change/username/', [
            'username' => '',
            'new_username' => $changedUsername
        ]);

        //Getting the username error
        $response->assertJsonValidationErrors('username');
    }
}