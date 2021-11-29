<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class GetUsersTest extends TestCase
{
    use RefreshDatabase;

    public function admin()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Get a user
        $admin = User::factory()->create(['is_admin' => 1]);

        //Logging a user in
        $this->actingAs($admin);

        //Checking if the user is successfully logged in
        $this->assertTrue(Auth::check());

        return $admin;
    }

    public function test_get_users()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Getting admin
        $admin = $this->admin();

        //Checking if the faqs have been sent back
        $response = $this->json('GET', '/admin/get_user');
        $response->assertStatus(200);
    }
}