<?php

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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->longText('question');
            $table->string('question_img')->nullable();
            $table->enum('answer_type', ['multi_opt', 'one_opt', 'bool', 'typed'])->default('one_opt');
            $table->longText('option_a')->nullable();
            $table->longText('option_b')->nullable();
            $table->longText('option_c')->nullable();
            $table->longText('option_d')->nullable();
            $table->longText('option_e')->nullable();
            $table->longText('option_f')->nullable();
            $table->longText('option_g')->nullable();
            $table->longText('correct_options')->nullable();
            $table->longText('explanation')->nullable();
            $table->foreignId('test_id')->constrained('tests');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
