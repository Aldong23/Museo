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
        Schema::create('cultural_institutions', function (Blueprint $table) {
            $table->id();
            $table->string('cultural_heritage_category');
            $table->string('cultural_heritage_type');
            $table->string('name');
            //  for featured_collections
            $table->json('photo_details');
            //
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('location')->nullable();
            $table->string('type_of_cultural_institutions')->nullable();
            $table->string('remarks_image')->nullable();
            $table->text('remarks_text')->nullable();
            $table->text('narrative_description')->nullable();
            $table->text('stories')->nullable();
            $table->text('significance')->nullable();

            $table->json('supporting_documentation')->nullable();
            $table->text('key_informats')->nullable();
            $table->text('mappers')->nullable();
            $table->date('date_profiled')->nullable();
            $table->json('farmers_association')->nullable();

            //attri for association
            $table->text('assessment')->nullable();

            //attri for library
            $table->json('organizational_chart')->nullable();
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
        Schema::dropIfExists('cultural_institutions');
    }
};
