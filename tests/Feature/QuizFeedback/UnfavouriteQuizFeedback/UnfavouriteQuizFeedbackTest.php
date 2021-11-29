<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Quiz;
use App\Models\FavouriteQuizFeedback;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UnfavouriteQuizFeedbackTest extends TestCase
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

    public function test_unfavourite_quiz_feedback()
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

        //Unfavourite quiz feedback
        $unfavourite_quiz_feedback_response = $this->json('DELETE', '/quiz_feedback/unfavourite/'.$favourite_quiz_feedback_response->getData()->id);

        //Checking if the quiz feedback favourite has been deleted
        $unfavourite_quiz_feedback_response->assertStatus(204);

        $this->assertCount(0, FavouriteQuizFeedback::get());
    }
}