<?php

namespace Database\Factories;

use App\Models\QuizFeedback;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFeedbackFactory extends Factory
{
    protected $model = QuizFeedback::class;

    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-1 day');
        return [
            'user_id' => 1,
            'quiz_id' => 1,
            'body' => $this->faker->text($maxNbChars = 2000),
            'created_at'=> $date,
            'updated_at'=> $date,
        ];
    }
}
