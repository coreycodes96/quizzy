<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class GetAnnouncementsUserTest extends TestCase
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

    public function test_get_announcements()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Getting user
        $user = $this->user();

        //Checking if the announcements have been sent back
        $response = $this->json('GET', '/announcements/show');
        $response->assertStatus(200);
    }
}