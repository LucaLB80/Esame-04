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

        Schema::create('comuni_italiani', function (Blueprint $table) {

            $table->id('idComune'); // BIGINT / UNSIGNED / AUTO_INCREMENT / PRIMARY KEY

            $table->string('comune', 50); // Nome del comune
            $table->string('regione', 50); // Nome della regione
            $table->string('provincia', 50); // Nome della provincia
            $table->string('zona', 50)->nullable(); // Zona, può essere nullo
            $table->char('sigla_provincia', 2); // Sigla della provincia
            $table->string('codice_istat', 10)->nullable(); // Codice ISTAT
            $table->integer('abitanti')->default(0)->nullable(); // Numero di abitanti
            $table->decimal('superficie', 10, 2)->default(0)->nullable(); // Superficie in km²
            $table->string('cap', 10); // Codice di avviamento postale
            $table->integer('altitudine')->default(0)->nullable(); // Altitudine sul livello del mare
            $table->integer('popolazione_residente')->default(0)->nullable(); // Popolazione residente
            $table->timestamps(); // Campi created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comuni');
    }
};
