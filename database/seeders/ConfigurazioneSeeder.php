<?php

namespace Database\Seeders;

use App\Models\Configurazione;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurazioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configurazione::create(
            [

                "chiave" => "maxLoginErrati",
                "valore" => "5"

            ]
        );
        Configurazione::create(
            [

                "chiave" => "durataSfida",
                "valore" => "30"

            ]
        );
        Configurazione::create(
            [

                "chiave" => "durataSessione",
                "valore" => "60000"

            ]
        );
        Configurazione::create(
            [

                "chiave" => "storicoPsw",
                "valore" => "3"

            ]
        );
    }
}
