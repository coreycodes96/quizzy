<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FavouriteQuizValidationTest extends TestCase
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

    public function newQuiz(int $user_id)
    {
        //Quiz info
        $quiz = Quiz::factory()->create();

        //Fake storage disk
        Storage::fake('public');

        //Create an image
        $image = UploadedFile::fake()->image('photo1.jpg');

        //Make a request to create a quiz
        $response = $this->json('POST', '/quiz/create', [
            'user_id' => $user_id,
            'title' => $quiz->title,
            'image' => $image,
            'data' => $quiz->data,
        ]);

        //Checking that the quiz has been created
        $response->assertStatus(201);

        return $response->getData();
    }

    public function test_favourite_quiz_user_id_is_required()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Get the users
        $user = $this->user();

        //Get the quiz
        $quiz = $this->newQuiz($user->id);

        //Making a request to favourite a quiz
        $favourite_quiz = $this->json('POST', 'quiz/favourite/', [
            'user_id' => '',
            'quiz_id' => $quiz->id
        ]);

        //Getting the user_id error
        $favourite_quiz->assertJsonValidationErrors('user_id');
    }

    public function test_favourite_quiz_id_is_required()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Get the users
        $user = $this->user();

        //Get the quiz
        $quiz = $this->newQuiz($user->id);

        //Making a request to favourite a quiz
        $favourite_quiz = $this->json('POST', 'quiz/favourite/', [
            'user_id' => $user->id,
            'quiz_id' => ''
        ]);

        //Getting the quiz_id
        $favourite_quiz->assertJsonValidationErrors('quiz_id');
    }
}
