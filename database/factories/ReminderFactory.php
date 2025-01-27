<?php

namespace Database\Factories;

use App\Models\Label;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reminder>
 */
class ReminderFactory extends Factory
{
    protected $model = Reminder::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'type' => $this->faker->randomElement(['Task', 'Event']),
            'priority' => $this->faker->randomElement(['High', 'Medium', 'Low']),
            'status' => $this->faker->randomElement(['Completed', 'In progress', 'Pending']),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Reminder $reminder) {
            $labels = Label::inRandomOrder()->take(3)->get();
            $reminder->labels()->attach($labels);
        });
    }
}
