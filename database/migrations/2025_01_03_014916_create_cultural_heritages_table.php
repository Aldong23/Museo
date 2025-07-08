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
        Schema::create('cultural_heritages', function (Blueprint $table) {
            $table->id();
            $table->string('cultural_heritage_category');
            $table->string('cultural_heritage_type');
            $table->string('name');
            //  for featured_collections
            $table->json('photo_details'); // photo_craedit and Photo_date
            // for Background Information
            $table->string('sub_category')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('location')->nullable();
            $table->string('address')->nullable();
            $table->string('area')->nullable();
            $table->string('ownership')->nullable(); // jurisdiction

            //
            $table->text('description')->nullable();
            $table->text('stories')->nullable();
            $table->text('significance')->nullable();
            $table->text('conservation')->nullable();
            $table->text('references')->nullable();
            $table->text('name_of_mapper')->nullable();
            $table->date('date_profiled')->nullable();


            // plants
            $table->string('other_common_name')->nullable();
            $table->string('scientific_name')->nullable();
            $table->string('classification_growth_habit')->nullable();
            $table->string('classification_origin')->nullable();
            $table->string('habitat')->nullable();
            $table->string('indicate_visibility')->nullable();
            $table->string('indicate_seasonability')->nullable();
            $table->json('common_uses')->nullable();
            $table->text('remarks')->nullable();

            // animal
            $table->string('classification')->nullable();
            $table->text('special_notes')->nullable(); // Use text for potentially long notes
            $table->string('time_of_year_most_seen')->nullable();


            // protected area
            $table->string('category')->nullable();
            $table->string('legislation_date')->nullable();

            // critical area
            $table->string('existing_hazard_type')->nullable();
            $table->text('summary')->nullable();
            $table->string('attachment')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cultural_heritages');
    }
};
