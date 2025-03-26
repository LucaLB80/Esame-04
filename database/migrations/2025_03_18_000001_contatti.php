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
        Schema::create('contatti', function (Blueprint $table) {
            $table->id('idContatto'); // BIGINT / UNSIGNED / AUTO_INCREMENT / PRIMARY KEY
            $table->bigInteger('idContattoStato')->unsigned()->default(4);
            $table->string('nome', 45)->nullable();
            $table->string('cognome', 45);
            $table->tinyInteger('sesso')->unsigned()->nullable();
            $table->string('codiceFiscale', 16)->nullable();
            $table->bigInteger('partitaIva')->nullable();
            $table->string('cittadinanza', 45)->nullable();
            $table->bigInteger('idNazioneNascita')->unsigned()->nullable();
            $table->string('cittaNascita', 45)->nullable();
            $table->string('provinciaNascita', 45)->nullable();
            $table->date('dataNascita')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->tinyInteger('archiviato')->unsigned()->default(0);
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned();
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
        Schema::dropIfExists('contatti');
    }
};
