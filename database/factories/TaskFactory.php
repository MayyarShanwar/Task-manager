<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->randomElement(['Exercise','Dishes','Cleaning','Meating']),
            'user_id'=>fake()->randomElement(User::get()),
            'days' => json_encode(fake()->randomElements(['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],3)),
            'time_start' => $start =fake()->time(),
            'time_end' => Carbon::parse($start)->addHours(fake()->numberBetween(1,3)),
            'status'=>fake()->randomElement(['Waiting','In Progress','Completed','Canceled','Failed To Complete']),
            'one_time'=>fake()->boolean(),
            'started'=>fake()->boolean()
        ];
    }
}
