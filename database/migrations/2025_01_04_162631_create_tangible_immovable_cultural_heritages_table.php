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
        Schema::create('tangible_immovable_cultural_heritages', function (Blueprint $table) {
            $table->id();
            $table->string('cultural_heritage_category');
            $table->string('cultural_heritage_type');
            $table->string('name');
            //  for featured_collections
            $table->json('photo_details'); // photo_craedit and Photo_date
            // for Background Information
            $table->string('type')->nullable();
            $table->string('ownership')->nullable();
            $table->string('location')->nullable();
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('year_constructed')->nullable();
            $table->string('area')->nullable();
            $table->string('structure')->nullable();
            $table->string('estimated_age')->nullable();
            $table->string('ownership_jurisdiction')->nullable();
            $table->string('declaration_legislation')->nullable();
            //
            $table->text('description')->nullable();
            $table->text('stories')->nullable();
            $table->text('significance')->nullable();
            $table->text('condition_of_structure')->nullable();
            $table->text('remarks_1')->nullable()->nullable();
            $table->text('integrity_of_structure')->nullable();
            $table->text('remarks_2')->nullable()->nullable();
            $table->json('list_of_cultural_props')->nullable();
            $table->text('references')->nullable()->nullable();
            $table->text('name_of_mapper')->nullable();
            $table->date('date_profiled')->nullable();
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
        Schema::dropIfExists('tangible_immovable_cultural_heritages');
    }
};
