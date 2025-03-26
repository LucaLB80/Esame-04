<?php

namespace Database\Seeders;

use App\Models\ContattoRuolo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContattoRuoloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContattoRuolo::create(
            [
                "nome" => "Amministratore"
            ]
        );
        ContattoRuolo::create(
            [
                "nome" => "Utente"
            ]
        );
        ContattoRuolo::create(
            [
                "nome" => "Ospite"
            ]
        );
    }
}
