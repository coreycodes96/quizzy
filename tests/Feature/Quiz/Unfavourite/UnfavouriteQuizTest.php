<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UnfavouriteQuizTest extends TestCase
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

    public function test_quiz_delete_favourite()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Get the users
        $user1 = $this->user();
        $user2 = $this->user();

        //Quiz info
        $quiz = Quiz::factory()->create();

        Storage::fake('public');

        $image = UploadedFile::fake()->image('photo.jpg');

        //Making a request to get the quizzes
        $response = $this->json('POST', 'quiz/create/', [
            'user_id' => $user1->id,
            'title' => $quiz->title,
            'image' => $image,
            'data' => $quiz->data
        ]);

        //Checking if the quiz has been created
        $response->assertStatus(201);

        //Making a request to favourite a quiz
        $favourite_quiz = $this->json('POST', '/quiz/favourite/', [
            'user_id' => $user2->id,
            'quiz_id' => $quiz->id
        ]);

        //Checking if the favourite has been created
        $favourite_quiz->assertStatus(201);

        //Make a request to delete a quiz favourite
        $unfavourite_quiz = $this->json('DELETE', '/quiz/unfavourite/'.$favourite_quiz->getData()->id);

        //Checking if the favourite has been deleted
        $unfavourite_quiz->assertStatus(204);
    }
}