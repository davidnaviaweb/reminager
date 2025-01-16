<?php

namespace Database\Seeders;

use App\Models\Reminder;
use Illuminate\Database\Seeder;

class ReminderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reminder::factory()->count(50)->create();
    }
}
