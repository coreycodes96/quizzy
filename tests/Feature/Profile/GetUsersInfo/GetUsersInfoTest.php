<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class GetUsersInfoTest extends TestCase
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

    public function test_get_users_profile_info()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Getting user
        $user = $this->user();

        //Creating a request to get the users profile
        $response = $this->json('GET', '/profile/info/'.$user->username);

        //Checking if the profile is successful
        $response->assertOk();
    }

    public function test_users_profile_info_not_found()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Getting user
        $user = $this->user();
        
        //ID that does not exists
        $username = "John";

        //Creating a request to find a user
        $response = $this->json('GET', '/profile/'.$username);

        //Getting an error that the user has not been found
        $response->assertStatus(404);
    }
}