<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateAnAccountTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_an_account()
    {
        $this->withExceptionHandling();

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

        $response->assertStatus(201);

        $this->assertCount(1, User::get());
    }
}
