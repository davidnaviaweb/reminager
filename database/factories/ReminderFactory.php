<?php

namespace Database\Factories;

use App\Enums\ReminderPriority;
use App\Enums\ReminderStatus;
use App\Enums\ReminderType;
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
        $type = $this->faker->randomElement(ReminderType::getValues());

        $return = [
            'title' => $this->faker->name,
            'description' => $this->faker->sentence,
            'type' => $type,
            'priority' => $this->faker->randomElement(ReminderPriority::getValues()),
            'status' => $this->faker->randomElement(ReminderStatus::getValues()),
            'user_id' => User::inRandomOrder()->first()->id,
        ];

        if ($type === ReminderType::TASK->value) {
            $dueDateTime = $this->faker->dateTimeBetween('-1 month', '+2 month')->format('Y-m-d H:i');
            $return['due_date'] = $dueDateTime;
            $return['start_date'] = $dueDateTime;
            $return['end_date'] = $dueDateTime;
        } else {
            $return['start_date'] = $this->faker->dateTimeBetween('-1 month', '+2 month')->format('Y-m-d H:i');
            $endDateTime = $this->faker->dateTimeBetween($return['start_date'], $return['start_date'] . ' +2 days')->format('Y-m-d H:i');
            $return['end_date'] = $endDateTime;
            $return['due_date'] = $endDateTime;
        }

        return $return;
    }

    public function configure()
    {
        return $this->afterCreating(function (Reminder $reminder) {
            $labels = Label::inRandomOrder()->take(3)->get();
            $reminder->labels()->attach($labels);
        });
    }
}
