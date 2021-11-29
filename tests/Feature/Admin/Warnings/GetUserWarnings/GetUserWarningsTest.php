<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class GetUserWarningsTest extends TestCase
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

    public function test_get_user_warnings()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Getting admin
        $admin = $this->admin();

        //Getting user warning
        $response = $this->json('GET', '/admin/get_user_warning');

        //Checking if the warnings have been sent back
        $response->assertStatus(200);
    }
}