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
        Schema::create('artifacts_restorations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artifact_id')->constrained()->cascadeOnDelete();
            $table->string('valid_id')->nullable();
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('suffix')->nullable();
            $table->string('contact_no');
            $table->string('email')->nullable();
            $table->date('date_released')->nullable();
            $table->json('conservation_status_before')->nullable();
            $table->json('artifacts_before')->nullable();
            $table->text('remarks_before')->nullable();

            // for restored
            $table->date('date_restored')->nullable();
            $table->json('conservation_status_after')->nullable();
            $table->json('artifacts_after')->nullable();
            $table->text('remarks_after')->nullable();
            $table->string('status')->nullable();

            //
            $table->foreignId('released_by')->nullable()->constrained('users'); //released by
            $table->foreignId('received_by')->nullable()->constrained('users'); //released by
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artifacts_restorations');
    }
};
