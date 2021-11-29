<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Quiz;
use App\Models\QuizFeedback;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FavouriteQuizFeedbackTest extends TestCase
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

    public function test_favourite_quiz_feedback()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Get the user
        $user1 = $this->user();
        $user2 = $this->user();

        //Quiz Info
        $quiz = Quiz::factory()->create();

        Storage::fake('public');

        $image = UploadedFile::fake()->image('photo.jpg');

        //Create a quiz
        $response = $this->json('POST', '/quiz/create/', [
            'user_id' => $user1->id,
            'title' => $quiz->title,
            'image' => $image,
            'data' => $quiz->data
        ]);

        $response->assertStatus(201);

        //Create quiz feedback
        $quiz_feedback_response = $this->json('POST', '/quiz_feedback/create/', [
            'user_id' => $user2->id,
            'quiz_id' => $response->getData()->id,
            'body' => 'This is a body',
        ]);

        $quiz_feedback_response->assertStatus(201);

        //Favourite quiz feedback
        $favourite_quiz_feedback_response = $this->json('POST', '/quiz_feedback/favourite/', [
            'user_id' => $user1->id,
            'quiz_feedback_id' => $quiz_feedback_response->getData()->id,
        ]);

        //Checking if the quiz feedback favourite has been created
        $favourite_quiz_feedback_response->assertStatus(201);
    }
}