<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class SupportValidationsTest extends TestCase
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

    public function test_support_sender_id_is_required()
    {
        //Getting users
        $user1 = $this->user();
        $user2 = $this->user();

        //Creating a request to support a user
        $response = $this->json('POST', '/profile/support/', [
            'sender' => '',
            'receiver' => $user2->id
        ]);

        //Getting the sender error
        $response->assertJsonValidationErrors('sender');
    }

    public function test_support_receiver_id_is_required()
    {
        //Getting users
        $user1 = $this->user();
        $user2 = $this->user();

        //Creating a request to support a user
        $response = $this->json('POST', '/profile/support/', [
            'sender' => $user1->id,
            'receiver' => ''
        ]);

        //Getting the receiver error
        $response->assertJsonValidationErrors('receiver');
    }
}