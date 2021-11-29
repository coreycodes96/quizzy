<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UnsupportTest extends TestCase
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

    public function test_unsupport_a_user()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Getting users
        $user1 = $this->user();
        $user2 = $this->user();

        //Creating a request to support a user
        $response = $this->json('POST', '/profile/support/', [
            'sender' => $user1->id,
            'receiver' => $user2->id
        ]);

        //Checking if the sender has successfully supported the receiver
        $response->assertStatus(201);

        //Creating a request to unsupport the receiver
        $unsupport_response = $this->json('DELETE', '/profile/unsupport/'.$user2->id);

        //Checking if the sender has successfully unsupported the receiver
        $unsupport_response->assertStatus(204);
    }
}