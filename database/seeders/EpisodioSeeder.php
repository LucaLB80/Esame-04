<?php

namespace Database\Seeders;

use App\Models\Episodio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EpisodioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Episodio::create([
            "idSerie" => "4",
            "titolo" => "Chapter Six: The Monster",
            "descrizione" => null,
            "numeroStagione" => 1,
            "numeroEpisodio" => 6,
            "durata" => 57,
            "anno" => 2016,
            "idImmagine" => null,
            "idFilmato" => null
        ]);
        Episodio::create([
            "idSerie" => "1",
            "titolo" => "The One with the Blackout",
            "descrizione" => null,
            "numeroStagione" => 1,
            "numeroEpisodio" => 7,
            "durata" => 45,
            "anno" => 1994,
            "idImmagine" => null,
            "idFilmato" => null
        ]);
        Episodio::create([
            "idSerie" => "2",
            "titolo" => "Gray Matter",
            "descrizione" => null,
            "numeroStagione" => 1,
            "numeroEpisodio" => 5,
            "durata" => 53,
            "anno" => 2008,
            "idImmagine" => null,
            "idFilmato" => null
        ]);
        Episodio::create([
            "idSerie" => "3",
            "titolo" => "Vatos",
            "descrizione" => null,
            "numeroStagione" => 1,
            "numeroEpisodio" => 4,
            "durata" => 47,
            "anno" => 2010,
            "idImmagine" => null,
            "idFilmato" => null
        ]);
    }
}
