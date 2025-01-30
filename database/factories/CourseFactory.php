<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Course::class; 

    public function definition(): array
    {
        return [
             'title' => $this->faker->sentence(3),
             'price' => $this->faker->randomFloat(2, 8, 500),
             'start_date' => $this->faker->date(),
             'end_date' => $this->faker->date(),
             'details' => $this->faker->paragraph(),
             'instructor_name' => $this->faker->name(), 
            ];
    }
}
