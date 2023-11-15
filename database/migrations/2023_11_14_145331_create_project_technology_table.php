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
        Schema::create('project_technology', function (Blueprint $table) {

            $table->primary(['project_id', 'technology_id']); // NO allo stesso progetto e stessa tecnologia

            $table->unsignedBigInteger('project_id'); // creo la colonna
            $table->foreign('project_id') // assegno la collonna all'id project
                ->references('id') // referenza id
                ->on('projects'); // su progetti

            $table->unsignedBigInteger('technology_id'); //creo la colonna
            $table->foreign('technology_id') // assegno la collonna all'id tecnology
                ->references('id') // referenza id
                ->on('technologies'); // su progetti

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
