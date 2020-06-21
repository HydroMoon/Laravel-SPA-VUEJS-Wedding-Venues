<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenueServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venue_services', function (Blueprint $table) {
            $table->id();
            //Imaging and video
            $table->boolean('photography');
            $table->boolean('videography');

            //Management and assistance
            $table->boolean('organize_team');

            //Addons
            $table->boolean('overnight');
            $table->boolean('jirtg');

            //Capacity
            $table->smallInteger('guests');

            $table->foreignId('venue_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('venue_services');
    }
}
