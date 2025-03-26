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
        Schema::create('serie', function (Blueprint $table) {
            $table->id('idSerie'); // BIGINT / UNSIGNED / AUTO_INCREMENT / PRIMARY KEY
            $table->tinyInteger('idCategoria')->unsigned();
            $table->string('nome', 255);
            $table->string('descrizione', 255)->nullable();
            $table->tinyInteger('totaleStagioni')->unsigned()->nullable();
            $table->tinyInteger('numeroEpisodio')->unsigned()->nullable();
            $table->string('regista', 45)->nullable();
            $table->string('attori', 45)->nullable();
            $table->smallInteger('annoInizio')->unsigned()->nullable();
            $table->smallInteger('annoFine')->unsigned()->nullable();
            $table->integer('idImmagine')->unsigned()->nullable();
            $table->integer('idFilmato')->unsigned()->nullable();
            // Timestamp per soft delete
            $table->timestamp('deleted_at')->nullable();

            // Timestamps per created_at e updated_at
            $table->timestamps();
            // Definisce una foreign key sulla colonna "idCategoria",
            // che fa riferimento a "idCategoria" nella tabella "categorie"
            $table->foreign('idCategoria')->references('idCategoria')->on('categorie')->onDelete('cascade');
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
