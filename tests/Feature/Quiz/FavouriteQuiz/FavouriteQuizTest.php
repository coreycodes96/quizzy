<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FavouriteQuizTest extends TestCase
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

    public function test_favourite_a_quiz()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Get the users
        $user1 = $this->user();
        $user2 = $this->user();

        //Quiz info
        $quiz = Quiz::factory()->create();

        //Fake storage disk
        Storage::fake('public');

        //Create an image
        $image = UploadedFile::fake()->image('photo1.jpg');

        //Make a request to create a quiz
        $response = $this->json('POST', '/quiz/create', [
            'user_id' => $user1->id,
            'title' => $quiz->title,
            'image' => $image,
            'data' => $quiz->data,
        ]);

        //Checking that the quiz has been created
        $response->assertStatus(201);

        //Making a request to favouite a quiz
        $favourite_response = $this->json('POST', '/quiz/favourite/', [
            'user_id' => $user2->id,
            'quiz_id' => $response->getData()->id
        ]);

        //Checking the favourite has been created
        $favourite_response->assertStatus(201);
    }
}