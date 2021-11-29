<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DeleteQuizTest extends TestCase
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

    public function test_delete_a_quiz()
    {
        //Without exception handling
        $this->withExceptionHandling();

        //Get the user
        $user = $this->user();

        //Fake storage disk
        Storage::fake('public');

        //Create an image
        $image = UploadedFile::fake()->image('photo1.jpg');

        //Making a request to create a quiz
        $response = $this->json('POST', '/quiz/create/', [
            'user_id' => $user->id,
            'title' => 'This is a title',
            'image' => $image,
            'data' => json_encode(
                [
                    "question" => "What colour is the sky?",
                    "answer1" => "Red",
                    "answer2" => "Green",
                    "answer3" => "Purple",
                    "answer4" => "Blue",
                    "correct_answer" => "Blue",
                ],
            ),
        ]);

        //Checking if the quiz has been created
        $response->assertStatus(201);

        //Making a request to delete a quiz
        $delete_quiz = $this->json('DELETE', '/quiz/delete/'.$response->getData()->id);

        //Deleting the images from the file
        Storage::disk('public')->delete($response->getData()->image);
        Storage::disk('public')->assertMissing($response->getData()->image);
        
        //Checking the quiz has been deleted
        $delete_quiz->assertStatus(204);

        //Checking the quiz is not in the database
        $this->assertCount(0, Quiz::get());
    }
}