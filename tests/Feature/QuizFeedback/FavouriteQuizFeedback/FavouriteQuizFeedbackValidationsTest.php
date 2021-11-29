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

class FavouriteQuizFeedbackValidationsTest extends TestCase
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

    public function newQuiz()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Getting a user
        $user1 = $this->user();

        //Getting a quiz
        $quiz = Quiz::factory()->create();

        //Create fake storage
        Storage::fake('public');

        //Create a fake image file
        $image = UploadedFile::fake()->image('photo.jpg');

        //Creating a request to create a quiz
        $response = $this->json('POST', '/quiz/create/', [
            'user_id' => $user1->id,
            'title' => $quiz->title,
            'image' => $image,
            'data' => $quiz->data
        ]);

        //Checking the quiz has been created
        $response->assertStatus(201);

        return $response->getData();
    }

    public function test_favourite_quiz_feedback_user_id_is_required()
    {
        //Getting a user
        $user2 = $this->user();

        //Getting the quiz
        $quiz = $this->newQuiz();

        //Getting quiz feeback
        $quiz_feedback = QuizFeedback::factory()->create();

        //Creating a request to create feedback for a quiz
        $quiz_feedback_response = $this->json('POST', '/quiz_feedback/create/', [
            'user_id' => $user2->id,
            'quiz_id' => $quiz->id,
            'body' => $quiz_feedback->body,
        ]);

        //Checking the quiz feedback has been created
        $quiz_feedback_response->assertStatus(201);

        //Creating a request to favourite a quiz feedback
        $favourite_quiz_feedback_response = $this->json('POST', '/quiz_feedback/favourite/', [
            'user_id' => '',
            'quiz_feedback_id' => $quiz_feedback_response->getData()->id,
        ]);

        //Getting the user_id error
        $favourite_quiz_feedback_response->assertJsonValidationErrors('user_id');
    }

    public function test_favourite_quiz_feedback_quiz_feedback_id_is_required()
    {
        //Getting a user
        $user2 = $this->user();

        //Getting the quiz
        $quiz = $this->newQuiz();

        //Getting quiz feeback
        $quiz_feedback = QuizFeedback::factory()->create();

        //Creating a request to create feedback for a quiz
        $quiz_feedback_response = $this->json('POST', '/quiz_feedback/create/', [
            'user_id' => $user2->id,
            'quiz_id' => $quiz->id,
            'body' => $quiz_feedback->body,
        ]);

        //Checking the quiz feedback has been created
        $quiz_feedback_response->assertStatus(201);

        //Creating a request to favourite a quiz feedback
        $favourite_quiz_feedback_response = $this->json('POST', '/quiz_feedback/favourite/', [
            'user_id' => $user2->id,
            'quiz_feedback_id' => '',
        ]);

        //Getting the quiz_feedback_id error
        $favourite_quiz_feedback_response->assertJsonValidationErrors('quiz_feedback_id');
    }
}