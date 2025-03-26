<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                ContattoSeeder::class,
                ContattoAuthSeeder::class,
                ConfigurazioneSeeder::class,
                ContattoAccessoSeeder::class,
                ContattoPasswordSeeder::class,
                ContattoSessioneSeeder::class,
                ContattoRuoloSeeder::class,
                ContattoContattoRuoloSeeder::class,
                ContattoAbilitaSeeder::class,
                ContattoRuoloContattoAbilitaSeeder::class,
                ContattoStatoSeeder::class,
                ComuneItalianoSeeder::class,
                NazioneSeeder::class,
                CategoriaSeeder::class,
                FilmSeeder::class,
                SerieSeeder::class,
                EpisodioSeeder::class,


            ]

        );
    }
}
