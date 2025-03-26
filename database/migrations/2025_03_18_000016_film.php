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
        Schema::create('film', function (Blueprint $table) {
            $table->id('idFilm'); // BIGINT / UNSIGNED / AUTO_INCREMENT / PRIMARY KEY
            $table->tinyInteger('idCategoria')->unsigned();
            $table->string('titolo', 255);
            $table->text('descrizione')->nullable();
            $table->tinyInteger('durata')->unsigned()->nullable();
            $table->string('regista', 45)->nullable();
            $table->string('attori', 45)->nullable();
            $table->smallInteger('anno')->unsigned()->nullable();
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
        Schema::dropIfExists('film');
    }
};
