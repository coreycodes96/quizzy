<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ShowQuizTest extends TestCase
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

    public function test_show_quizzes()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Get the user
        $user = $this->user();

        //Making a request to get the quizzes
        $response = $this->json('GET', 'quiz/show');

        //Checking if the request has a 200 status (OK)
        $response->assertOk();
    }
}