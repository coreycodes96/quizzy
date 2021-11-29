<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateQuizTest extends TestCase
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

    public function test_creating_a_quiz()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Getting user
        $user = $this->user();

        //Quiz info
        $quiz = Quiz::factory()->create();

        //Fake storage disk
        Storage::fake('public');

        //Create an image
        $image = UploadedFile::fake()->image('photo1.jpg');

        //Create a request to create a quiz
        $response = $this->json('POST', '/quiz/create', [
            'user_id' => $user->id,
            'title' => $quiz->title,
            'image' => $image,
            'data' => $quiz->data
        ]);
        
        //Status to check if the quiz has been created
        $response->assertStatus(201);
    }

    public function test_storing_an_image()
    {
        $this->withExceptionHandling();

        //Created user
        $user = $this->user();

        //Quiz info
        $quiz = Quiz::factory()->create();

        //Fake storage disk
        Storage::fake('public');

        //Create an image
        $image = UploadedFile::fake()->image('photo1.jpg');

        //Create a request to create a quiz
        $response = $this->json('POST', '/quiz/create', [
            'user_id' => $user->id,
            'title' => 'hi',
            'image' => $image,
            'data' => $quiz->data,
        ]);

        //Status to check if the quiz has been created
        $response->assertStatus(201);
        
        //Checking the post image has been created
        $this->assertNotNull($response->getData()->image);
        
        //Checking if the image has been stored
        Storage::disk('public')->assertExists($response->getData()->image);
        
        //Checking if the file exists
        $this->assertTrue(Storage::disk('public')->exists($response->getData()->image));
    }
}