<?php

namespace Database\Seeders;

use App\Models\Contatto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContattoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contatto::create(
            [
                "nome" => "Luca",
                "cognome" => "Grandi",
                "sesso" => 1,
                "created_by" => 1,
                "updated_by" => 1

            ]
        );
        Contatto::create(
            [
                "nome" => "Mario",
                "cognome" => "Verdi",
                "sesso" => 1,
                "created_by" => 1,
                "updated_by" => 1
            ]
        );
        Contatto::create(
            [
                "nome" => "Maria",
                "cognome" => "Bianchi",
                "sesso" => 0,
                "created_by" => 1,
                "updated_by" => 1
            ]
        );
    }
}
