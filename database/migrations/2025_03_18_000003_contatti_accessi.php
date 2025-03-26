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
        Schema::create('contatti_accessi', function (Blueprint $table) {
            $table->id('id'); // BIGINT / UNSIGNED / AUTO_INCREMENT / PRIMARY KEY
            $table->unsignedBigInteger('idContatto');
            $table->tinyInteger('autenticato')->unsigned()->default(0)->index();
            $table->string('ip', 15)->nullable();
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
        Schema::dropIfExists('contatti_accessi');
    }
};
