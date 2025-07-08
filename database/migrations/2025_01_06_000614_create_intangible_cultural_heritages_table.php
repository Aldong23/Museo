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
        Schema::create('intangible_cultural_heritages', function (Blueprint $table) {
            $table->id();
            $table->string('cultural_heritage_category');
            $table->string('cultural_heritage_type');
            $table->string('name');
            //  for featured_collections
            $table->json('photo_details'); // photo_craedit and Photo_date
            //
            $table->string('type')->nullable();
            $table->text('geographical_location')->nullable();
            $table->string('related_domains')->nullable();
            $table->text('summary_of_elements')->nullable();

            //
            $table->json('list_of_tangible_movable_heritage')->nullable();
            $table->json('list_of_flora_fauna')->nullable();
            //
            $table->text('stories')->nullable();
            $table->text('significance')->nullable();
            $table->text('assessment_of_practice')->nullable();
            $table->string('measures_and_description_dropdown')->nullable();
            $table->text('measures_and_description_text')->nullable();
            $table->json('supporting_documentation')->nullable();
            $table->text('key_informat')->nullable();
            $table->text('mappers')->nullable();
            $table->date('date_profiled')->nullable();
            $table->text('attachment_text')->nullable();
            $table->string('attachment_image')->nullable();
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
        Schema::dropIfExists('intangible_cultural_heritages');
    }
};
