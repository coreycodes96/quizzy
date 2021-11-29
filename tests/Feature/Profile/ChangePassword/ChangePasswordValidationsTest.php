<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ChangePasswordValidationsTest extends TestCase
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

    public function test_change_password_the_new_password_is_required()
    {
        //Getting user
        $user = $this->user();

        //Changed password
        $changedPassword = 'test1234';

        //Creating a request to change the password
        $response = $this->json('PUT', '/profile/change/password/', [
            'new_password' => '',
            'current_password' => $user->password,
        ]);

        //Getting new_password error
        $response->assertJsonValidationErrors('new_password');
    }

    public function test_change_password_the_new_password_min()
    {
        //Getting user
        $user = $this->user();

        //Changed password
        $changedPassword = 'test123';

        //Creating a request to change the password
        $response = $this->json('PUT', '/profile/change/password/', [
            'new_password' => $changedPassword,
            'current_password' => $user->password,
        ]);

        //Getting new_password error
        $response->assertJsonValidationErrors('new_password');
    }

    public function test_change_password_the_new_password_max()
    {
        //Getting user
        $user = $this->user();

        //Changed password
        $changedPassword = 'HnkzQBT3HxWXzTKCjhqre9KCjPwPBKyLvRqp6Xn3BkFTAXzmHHx79cgfSj2yx8NR3nLSHgqKhUXQgX5W6X9wW65jWm8BTx7uztaTMztwmNVLMcuXHmmzJKQ8VkKkvJ2MUn3UACpFAcrGkvSuPCQUz99tWRGUZTz3YpmWSyaL54ywbFguxzbnW7WMJddcSvQr4H7F3DEKwYxmTtFrqMsXJbRqgEQ3QfUyHhznBMLkEr3ncN8L4YwZXLrshqjWGRwY';

        //Creating a request to change the password
        $response = $this->json('PUT', '/profile/change/password/', [
            'new_password' => $changedPassword,
            'current_password' => $user->password,
        ]);

        //Getting new_password error
        $response->assertJsonValidationErrors('new_password');
    }

    public function test_change_password_the_current_password_is_required()
    {
        //Getting user
        $user = $this->user();

        //Changed password
        $changedPassword = 'Test1234';

        //Creating a request to change the password
        $response = $this->json('PUT', '/profile/change/password/', [
            'new_password' => $changedPassword,
            'current_password' => '',
        ]);

        //Getting current_password error
        $response->assertJsonValidationErrors('current_password');
    }
}