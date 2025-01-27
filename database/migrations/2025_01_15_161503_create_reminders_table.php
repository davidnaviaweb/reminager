<?php

use App\Enums\ReminderPriority;
use App\Enums\ReminderStatus;
use App\Enums\ReminderType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->enum('type', array_column(ReminderType::cases(), 'value'))->default(ReminderType::TASK->value);
            $table->enum('priority', array_column(ReminderPriority::cases(), 'value'))->default(ReminderPriority::MEDIUM->value);
            $table->enum('status', array_column(ReminderStatus::cases(), 'value'))->default(ReminderStatus::PENDING->value);
            $table->dateTimeTz('due_date');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
