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
        Schema::table('projects', function (Blueprint $table) {
            // AGGIUNGE L'ID DI TYPE DOPO LA COLONNA ID
            $table->unsignedBiginteger('type_id')->nullable()->after('id');

            $table->foreign('type_id') // asseggna la foreing key  ad type_id che è legata al TYPE che abbiamo creato
                ->references('id') // si lega ad id
                ->on('types'); // che si trova nella tabella types
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('projects_type_id_foreign'); // distrugge LA FK type_id dalla tab projects
            $table->dropColumn('type_id'); // elimina la colonna type_id
        });
    }
};
