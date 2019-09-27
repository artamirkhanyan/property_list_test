<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200);
            $table->text('description');
            $table->smallInteger('bedroom');
            $table->smallInteger('bathroom');

            $table->boolean('for_sale');
            $table->boolean('for_rent');

            // Project name
            $table->unsignedInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects');

            // Project type
            $table->unsignedInteger('property_type_id');
            $table->foreign('property_type_id')->references('id')->on('property_types');

            // Project status
            $table->unsignedInteger('status_id');
            $table->foreign('status_id')->references('id')->on('statuses');

            // Region
            $table->unsignedInteger('region_id');
            $table->foreign('region_id')->references('id')->on('regions');

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
        Schema::dropIfExists('properties');
    }
}
