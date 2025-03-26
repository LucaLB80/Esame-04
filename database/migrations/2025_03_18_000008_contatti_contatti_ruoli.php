<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contatti_contatti_ruoli', function (Blueprint $table) {
            $table->id(); // BIGINT / UNSIGNED / AUTO_INCREMENT / PRIMARY KEY
            $table->unsignedBigInteger('idContatto');
            $table->unsignedBigInteger('idContattoRuolo');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('idContatto')->references('idContatto')->on('contatti')->onDelete('cascade');
            $table->foreign('idContattoRuolo')->references('idContattoRuolo')->on('contatti_ruoli')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contatti_contatti_ruoli');
    }
};
