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
        Schema::create('episodi', function (Blueprint $table) {
            $table->id('idEpisodio'); // BIGINT / UNSIGNED / AUTO_INCREMENT / PRIMARY KEY
            $table->unsignedBigInteger('idSerie');
            $table->string('titolo', 255);
            $table->string('descrizione', 45)->nullable();
            $table->tinyInteger('numeroStagione')->nullable();
            $table->tinyInteger('numeroEpisodio')->nullable();
            $table->tinyInteger('durata')->nullable();
            $table->smallInteger('anno')->nullable();
            $table->unsignedBigInteger('idImmagine')->nullable();
            $table->unsignedBigInteger('idFilmato')->nullable();
            // Timestamp per soft delete
            $table->timestamp('deleted_at')->nullable();

            // Timestamps per created_at e updated_at
            $table->timestamps();
            // Definisce una foreign key sulla colonna "idSerie",
            // che fa riferimento a "idSerie" nella tabella "serie"
            $table->foreign('idSerie')->references('idSerie')->on('serie')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serie');
    }
};
