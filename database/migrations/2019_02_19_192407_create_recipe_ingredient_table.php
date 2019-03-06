<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeIngredientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_ingredient', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedInteger('recipe_id');
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            $table->unsignedInteger('ingredient_id');
            $table->foreign('ingredient_id')->references('id')->on('ingredients');
            $table->unsignedInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('units');
            $table->integer('value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_ingredient');
    }
}
