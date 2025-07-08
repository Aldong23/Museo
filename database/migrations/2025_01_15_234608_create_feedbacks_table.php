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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_record_id')->constrained('visitor_records');
            $table->string('name');
            $table->string('control_no')->nullable();
            $table->string('client');
            $table->string('lang');
            $table->string('sex')->nullable();
            $table->integer('age')->nullable();
            $table->string('religion')->nullable();
            $table->string('email')->nullable();
            $table->text('purpose')->nullable();
            $table->date('current_date');

            //cb
            $table->string('q1')->nullable();
            $table->string('q2')->nullable();
            $table->string('q3')->nullable();

            $table->string('satisfaction_0')->nullable();
            $table->string('satisfaction_1')->nullable();
            $table->string('satisfaction_2')->nullable();
            $table->string('satisfaction_3')->nullable();
            $table->string('satisfaction_4')->nullable();
            $table->string('satisfaction_5')->nullable();
            $table->string('satisfaction_6')->nullable();
            $table->string('satisfaction_7')->nullable();
            $table->string('satisfaction_8')->nullable();
            $table->string('optional')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
