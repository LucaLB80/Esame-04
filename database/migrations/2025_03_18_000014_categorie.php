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
        Schema::create('categorie', function (Blueprint $table) {
            $table->tinyInteger('idCategoria')->unsigned()->primary(); //Se non metti primary(), la colonna non sarà una chiave primaria perche e diverso da id
            $table->string('nome', 45);
            // Timestamp per soft delete
            $table->timestamp('deleted_at')->nullable();

            // Timestamps per created_at e updated_at
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
        Schema::dropIfExists('categorie');
    }
};
