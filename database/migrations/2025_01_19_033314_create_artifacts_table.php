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
        Schema::create('artifacts', function (Blueprint $table) {
            $table->id();
            $table->string('artifact_no')->unique()->nullable();
            $table->string('category');
            $table->string('type');
            $table->string('name');

            $table->date('date_photograph')->nullable();
            $table->string('owned_by')->nullable();
            $table->string('donated_by')->nullable();

            $table->text('description');
            $table->text('story')->nullable();
            $table->json('collections')->nullable();
            $table->unsignedBigInteger('views')->default(0);

            // if the artifact if from contributor
            $table->date('date_profiled')->nullable();
            $table->text('remarks')->nullable();
            $table->string('status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artifacts');
    }
};
