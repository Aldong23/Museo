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
        Schema::create('tangible_movable_cultural_heritages', function (Blueprint $table) {
            $table->id();
            $table->string('cultural_heritage_category');
            $table->string('cultural_heritage_type');
            $table->string('name');
            //  for featured_collections
            $table->json('photo_details'); // photo_craedit and Photo_date
            //
            $table->string('type')->nullable();
            $table->date('date_of_record')->nullable();
            // volume / size
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('arrangement')->nullable();
            $table->string('office_of_origin')->nullable();
            $table->string('contact_person')->nullable();
            $table->text('description')->nullable();
            $table->json('description_of_material')->nullable();
            $table->text('remarks_1')->nullable();
            //
            $table->text('stories')->nullable();
            $table->text('significance')->nullable();
            //
            $table->json('physical_condition')->nullable();
            $table->text('remarks_2')->nullable();
            $table->text('narration')->nullable();
            $table->text('references')->nullable();
            $table->text('mappers')->nullable();
            $table->date('date_profiled')->nullable();
            // ============================================= Added attrib for Ethnogrphic Object
            $table->date('date_produced')->nullable();
            $table->string('estimated_age')->nullable();
            $table->string('name_of_owner')->nullable();
            $table->string('type_of_acquisition')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tangible_movable_cultural_heritages');
    }
};
