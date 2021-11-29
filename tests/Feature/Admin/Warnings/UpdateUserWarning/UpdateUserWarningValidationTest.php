<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UpdateUserWarningValidationsTest extends TestCase
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

    public function test_warning_user_id_is_required()
    {
        //Getting user 
        $user = $this->user();

        //Getting admin
        $admin = $this->admin();

        //Trying to update user warning
        $response = $this->json('PUT', '/admin/update_user_warning', [
            'id' => '',
            'warning' => $user->warnings
        ]);

        //Getting error response
        $response->assertJsonValidationErrors('id');
    }

    public function test_warning_user_warning_is_required()
    {
        //Getting user 
        $user = $this->user();

        //Getting admin
        $admin = $this->admin();

        //Trying to update user warning
        $response = $this->json('PUT', '/admin/update_user_warning', [
            'id' => $user->id,
            'warnings' => ''
        ]);

        //Getting error response
        $response->assertJsonValidationErrors('warnings');
    }
}