<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Film::create([
            "idCategoria" => "1",
            "titolo" => "The Nun",
            "descrizione" => null,
            "durata" => null,
            "regista" => null,
            "attori" => null,
            "anno" => null,
            "idImmagine" => null,
            "idFilmato" => null
        ]);

        Film::create([
            "idCategoria" => "2",
            "titolo" => "Avatar",
            "descrizione" => null,
            "durata" => null,
            "regista" => null,
            "attori" => null,
            "anno" => null,
            "idImmagine" => null,
            "idFilmato" => null
        ]);

        Film::create([
            "idCategoria" => "3",
            "titolo" => "Shutter Island",
            "descrizione" => null,
            "durata" => null,
            "regista" => null,
            "attori" => null,
            "anno" => null,
            "idImmagine" => null,
            "idFilmato" => null
        ]);

        Film::create([
            "idCategoria" => "7",
            "titolo" => "La vita è bella",
            "descrizione" => null,
            "durata" => null,
            "regista" => null,
            "attori" => null,
            "anno" => null,
            "idImmagine" => null,
            "idFilmato" => null
        ]);
    }
}
