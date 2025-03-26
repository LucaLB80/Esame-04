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
        Schema::create('contatti_auth', function (Blueprint $table) {
            $table->id('idContattoAuth'); // BIGINT / UNSIGNED / AUTO_INCREMENT / PRIMARY KEY
            $table->bigInteger('idContatto')->unsigned();
            $table->string('user', 255)->unique();
            $table->string('sfida', 255)->nullable();
            $table->string('secretJWT', 255);
            $table->integer('inizioSfida')->unsigned();
            $table->tinyInteger('obbligoCambio')->unsigned()->default(0);
            $table->timestamps(); // created_at e updated_at (TIMESTAMP NULL)

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
        Schema::dropIfExists('contatti_auth');
    }
};
