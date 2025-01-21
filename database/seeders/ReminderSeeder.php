<?php
// database/seeders/ReminderSeeder.php

namespace Database\Seeders;

use App\Models\Reminder;
use App\Models\Label;
use Illuminate\Database\Seeder;

class ReminderSeeder extends Seeder
{
    public function run(): void
    {
        Label::insert([
            [
                'name' => 'Work',
                'backgroundColor' => '#3490dc',
                'textClass' => 'text-gray-800 dark:text-gray-200'
            ],
            [
                'name' => 'Social',
                'backgroundColor' => '#38c172',
                'textClass' => 'text-gray-800 dark:text-gray-200'
            ],
            [
                'name' => 'Personal',
                'backgroundColor' => '#f6993f',
                'textClass' => 'text-gray-200 dark:text-gray-800'
            ],
            [
                'name' => 'Health',
                'backgroundColor' => '#e3342f',
                'textClass' => 'text-gray-800 dark:text-gray-200'
            ],
            [
                'name' => 'Finance',
                'backgroundColor' => '#9561e2',
                'textClass' => 'text-gray-800 dark:text-gray-200'
            ],
        ]);

        Reminder::factory()->count(50)->create();
    }
}
