<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignificantPersonalitiesTable extends Migration
{
    public function up()
    {
        Schema::create('significant_personalities', function (Blueprint $table) {
            $table->id();
            $table->string('cultural_heritage_category');
            $table->string('cultural_heritage_type');
            $table->string('name');
            //  for featured_collections
            $table->json('photo_details'); // photo_craedit and Photo_date

            $table->date('date_of_birth');
            $table->date('date_of_death');
            $table->integer('age');
            $table->string('prominence');
            $table->string('birthplace');
            $table->string('present_address');
            $table->text('biography');
            $table->text('significance');
            $table->text('references');
            $table->text('mapper');
            $table->date('date_profiled');
            $table->text('attachment')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('significant_personalities');
    }
}
