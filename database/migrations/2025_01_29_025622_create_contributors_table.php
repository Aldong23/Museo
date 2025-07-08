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
        Schema::create('contributors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artifact_id')->constrained();
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('suffix')->nullable();
            $table->string('sex')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->string('province')->nullable();
            $table->string('municipality')->nullable();
            $table->string('barangay')->nullable();
            $table->string('address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributors');
    }
};
