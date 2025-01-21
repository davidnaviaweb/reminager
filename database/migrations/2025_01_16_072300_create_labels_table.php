<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('backgroundColor');
            $table->string('textClass');
            $table->timestamps();
        });

        Schema::create('label_reminder', function (Blueprint $table) {
            $table->id();
            $table->foreignId('label_id')->constrained()->onDelete('cascade');
            $table->foreignId('reminder_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('label_reminder');
        Schema::dropIfExists('labels');
    }
};
