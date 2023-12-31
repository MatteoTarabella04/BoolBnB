<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('apartment_type_id');
            $table->foreign('apartment_type_id')->references('id')->on('apartment_types');
            $table->string('name');
            $table->text('description');
            $table->decimal('price_per_night', 8, 2)->index();
            $table->unsignedTinyInteger('rooms')->index();
            $table->unsignedTinyInteger('beds')->index();
            $table->unsignedTinyInteger('bathrooms');
            $table->unsignedSmallInteger('square_meters');
            $table->text('address');
            $table->decimal('latitude', 8, 6)->index();
            $table->decimal('longitude', 9, 6)->index();
            $table->string('image');
            $table->boolean('visible')->default(1);
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
};
