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

class ShowQuizFeedbackTest extends TestCase
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

    public function test_get_quiz_feeback(){
        //Without exception handling
        $this->withExceptionHandling();

        //Get the user
        $user = $this->user();
        
        /* Creating A Quiz */

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

        /* Getting Quiz Feedback */
        $show_quiz_feedback = $this->json('GET', '/quiz_feedback/show/'.$response->getData()->id);
        $show_quiz_feedback->assertStatus(200);
    }
}