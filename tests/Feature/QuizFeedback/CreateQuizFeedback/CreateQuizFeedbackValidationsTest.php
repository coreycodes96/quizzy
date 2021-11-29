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

class CreateQuizFeedbackValidationsTest extends TestCase
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

    public function test_quiz_feedback_user_id_is_required()
    {
        //Getting a user
        $user2 = $this->user();

        //Getting the quiz
        $quiz = $this->newQuiz();

        //Getting quiz feeback
        $quiz_feedback = QuizFeedback::factory()->create();

        //Creating a request to create feedback for a quiz
        $quiz_feedback_response = $this->json('POST', '/quiz_feedback/create/', [
            'user_id' => '',
            'quiz_id' => $quiz->id,
            'body' => $quiz_feedback->body,
        ]);

        //Getting the user_id error
        $quiz_feedback_response->assertJsonValidationErrors('user_id');
    }

    public function test_quiz_feedback_quiz_id_is_required()
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
            'quiz_id' => '',
            'body' => $quiz_feedback->body,
        ]);

        //Getting the quiz_id error
        $quiz_feedback_response->assertJsonValidationErrors('quiz_id');
    }

    public function test_quiz_feedback_body_is_required()
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
            'body' => '',
        ]);

        //Getting the body error
        $quiz_feedback_response->assertJsonValidationErrors('body');
    }

    public function test_quiz_feedback_body_max()
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
            'body' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibu',
        ]);

        //Getting the body error
        $quiz_feedback_response->assertJsonValidationErrors('body');
    }
}