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
        Schema::create('contatti_sessioni', function (Blueprint $table) {
            $table->id('idContattoSessione'); // BIGINT / UNSIGNED / AUTO_INCREMENT / PRIMARY KEY
            $table->unsignedBigInteger('idContatto');
            $table->text('token');
            $table->unsignedBigInteger('inizioSessione');

            // Timestamps per created_at e updated_at
            $table->timestamps();

            // Definisce una foreign key sulla colonna "idContatto",
            // che fa riferimento a "idContatto" nella tabella "contatti"
            $table->foreign('idContatto')->references('idContatto')->on('contatti')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contatti_sessioni');
    }
};
