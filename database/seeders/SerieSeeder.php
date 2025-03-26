<?php

namespace Database\Seeders;

use App\Models\Serie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Serie::create([
            "idCategoria" => "6",
            "nome" => "Friends",
            "descrizione" => null,
            "totaleStagioni" => null,
            "numeroEpisodio" => null,
            "regista" => null,
            "attori" => null,
            "annoInizio" => null,
            "annoFine" => null,
            "idImmagine" => null,
            "idFilmato" => null
        ]);

        Serie::create([
            "idCategoria" => "7",
            "nome" => "Breaking Bad",
            "descrizione" => null,
            "totaleStagioni" => 5,
            "numeroEpisodio" => null,
            "regista" => "Vince Gilligan",
            "attori" => "Bryan Cranston, Aaron Paul",
            "annoInizio" => 2008,
            "annoFine" => 2013,
            "idImmagine" => null,
            "idFilmato" => null
        ]);

        Serie::create([
            "idCategoria" => "1",
            "nome" => "The Walking Dead",
            "descrizione" => null,
            "totaleStagioni" => null,
            "numeroEpisodio" => null,
            "regista" => null,
            "attori" => null,
            "annoInizio" => null,
            "annoFine" => null,
            "idImmagine" => null,
            "idFilmato" => null
        ]);

        Serie::create([
            "idCategoria" => "15",
            "nome" => "Stranger Things",
            "descrizione" => null,
            "totaleStagioni" => null,
            "numeroEpisodio" => null,
            "regista" => null,
            "attori" => null,
            "annoInizio" => null,
            "annoFine" => null,
            "idImmagine" => null,
            "idFilmato" => null
        ]);
    }
}
