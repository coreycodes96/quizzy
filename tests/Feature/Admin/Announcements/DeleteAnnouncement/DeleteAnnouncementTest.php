<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DeleteAnnouncementTest extends TestCase
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

    public function test_delete_announcement()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Getting admin
        $admin = $this->admin();

        //Creating an announcement
        $create_announcement = $this->json('POST', '/admin/announcement/create', [
            'title' => 'This is a title',
            'body' => 'This is a body'
        ]);

        //Checking if the announcement has been created
        $create_announcement->assertStatus(201);

        //Deleting an announcement
        $response = $this->json('DELETE', 'admin/announcement/delete/'.$create_announcement->getData()->id);
        $response->assertStatus(204);
    }
}