<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UpdateUserWarningTest extends TestCase
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

    public function admin($warningCount)
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Get a user
        $admin = User::factory()->create(['is_admin' => 1, 'warnings' => $warningCount]);

        //Logging a user in
        $this->actingAs($admin);

        //Checking if the user is successfully logged in
        $this->assertTrue(Auth::check());

        return $admin;
    }

    public function test_first_user_warning()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Getting user
        $user = $this->user();

        //Getting admin
        $admin = $this->admin(0);

        //Updating user warning
        $response = $this->json('PUT', '/admin/update_user_warning', [
            'id' => $user->id,
            'warnings' => $admin->warnings
        ]);

        //Checking if the warnings have been updated
        $response->assertStatus(200);
    }

    public function test_second_user_warning()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Getting user
        $user = $this->user();

        //Getting admin
        $admin = $this->admin(1);

        //Updating user warning
        $response = $this->json('PUT', '/admin/update_user_warning', [
            'id' => $user->id,
            'warnings' => $admin->warnings
        ]);

        //Checking if the warnings have been updated
        $response->assertStatus(200);
    }

    public function test_third_user_warning()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Getting user
        $user = $this->user();

        //Getting admin
        $admin = $this->admin(2);

        //Updating user warning
        $response = $this->json('PUT', '/admin/update_user_warning', [
            'id' => $user->id,
            'warnings' => $admin->warnings
        ]);

        //Checking if the warnings have been updated
        $response->assertStatus(200);
    }
}