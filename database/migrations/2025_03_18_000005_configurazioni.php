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
        Schema::create('configurazioni', function (Blueprint $table) {
            $table->id('idConfigurazione'); // BIGINT / UNSIGNED / AUTO_INCREMENT / PRIMARY KEY
            $table->string('chiave', 255);
            $table->string('valore', 255);

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
        Schema::dropIfExists('configurazioni');
    }
};
