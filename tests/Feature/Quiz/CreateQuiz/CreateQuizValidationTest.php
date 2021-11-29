<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateQuizValidationTest extends TestCase
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

    public function test_create_a_quiz_user_id_is_required()
    {
        //Getting user
        $user = $this->user();

        //Quiz info
        $quiz = Quiz::factory()->create();

        //Fake storage disk
        Storage::fake('public');

        //Create an image
        $image = UploadedFile::fake()->image('photo1.jpg');

        //Create a request to create a quiz
        $response = $this->json('POST', '/quiz/create/', [
            'user_id' => '',
            'title' => $quiz->title,
            'image' => $image,
            'data' => $quiz->data
        ]);

        //Getting the error user_id error
        $response->assertJsonValidationErrors('user_id');
    }

    public function test_create_a_quiz_title_is_required()
    {
        //Getting user
        $user = $this->user();

        //Quiz info
        $quiz = Quiz::factory()->create();

        //Fake storage disk
        Storage::fake('public');

        //Create an image
        $image = UploadedFile::fake()->image('photo1.jpg');

        //Create a request to create a quiz
        $response = $this->json('POST', '/quiz/create/', [
            'user_id' => $user->id,
            'title' => '',
            'image' => $image,
            'data' => $quiz->data
        ]);

        //Getting the error title error
        $response->assertJsonValidationErrors('title');
    }

    public function test_create_a_quiz_title_max()
    {
        //Getting user
        $user = $this->user();

        //Quiz info
        $quiz = Quiz::factory()->create();

        //Fake storage disk
        Storage::fake('public');

        //Create an image
        $image = UploadedFile::fake()->image('photo1.jpg');

        //Create a request to create a quiz
        $response = $this->json('POST', '/quiz/create/', [
            'user_id' => $user->id,
            'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque interdum rutrum sodales. Nullam mattis fermentum libero, non volutpat....',
            'image' => $image,
            'data' => $quiz->data
        ]);

        //Getting the error title error
        $response->assertJsonValidationErrors('title');
    }

    public function test_create_a_quiz_image_is_required()
    {
        //Getting user
        $user = $this->user();

        //Quiz info
        $quiz = Quiz::factory()->create();

        //Create a request to create a quiz
        $response = $this->json('POST', '/quiz/create/', [
            'user_id' => $user->id,
            'title' => $quiz->title,
            'image' => '',
            'data' => $quiz->data
        ]);

        //Getting the error image error
        $response->assertJsonValidationErrors('image');
    }

    public function test_create_a_quiz_image_incorrect_extention()
    {
        //Getting user
        $user = $this->user();

        //Quiz info
        $quiz = Quiz::factory()->create();

        //Fake storage disk
        Storage::fake('public');

        //Create an image
        $image = UploadedFile::fake()->image('photo1.php');

        //Create a request to create a quiz
        $response = $this->json('POST', '/quiz/create/', [
            'user_id' => $user->id,
            'title' => $quiz->title,
            'image' => $image,
            'data' => $quiz->data
        ]);

        //Getting the error image error
        $response->assertJsonValidationErrors('image');
    }

    public function test_create_a_quiz_data_is_required()
    {
        //Getting user
        $user = $this->user();

        //Quiz info
        $quiz = Quiz::factory()->create();

        //Fake storage disk
        Storage::fake('public');

        //Create an image
        $image = UploadedFile::fake()->image('photo1.jpg');

        //Create a request to create a quiz
        $response = $this->json('POST', '/quiz/create/', [
            'user_id' => $user->id,
            'title' => $quiz->title,
            'image' => $image,
            'data' => []
        ]);

        //Getting the error data error
        $response->assertJsonValidationErrors('data');
    }
}