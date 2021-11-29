<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    protected $model = Quiz::class;

    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-1 day');
        return [
            'user_id' => 1,
            'title' => $this->faker->text($maxNbChars = 140),
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
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
            'created_at'=> $date,
            'updated_at'=> $date,
        ];
    }
}
