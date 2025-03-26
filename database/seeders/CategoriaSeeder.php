<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create(
            [
                "idCategoria" => 1,
                "nome" => "Horror"
            ]
        );
        Categoria::create(
            [
                "idCategoria" => 2,
                "nome" => "Fantasy"
            ]
        );
        Categoria::create(
            [
                "idCategoria" => 3,
                "nome" => "Thriller"
            ]
        );
        Categoria::create(
            [
                "idCategoria" => 4,
                "nome" => "Avventura"
            ]
        );
        Categoria::create(
            [
                "idCategoria" => 5,
                "nome" => "Azione"
            ]
        );
        Categoria::create(
            [
                "idCategoria" => 6,
                "nome" => "Commedia"
            ]
        );
        Categoria::create(
            [
                "idCategoria" => 7,
                "nome" => "Drammatico"
            ]
        );
        Categoria::create(
            [
                "idCategoria" => 8,
                "nome" => "Western"
            ]
        );
        Categoria::create(
            [
                "idCategoria" => 9,
                "nome" => "Biografico"
            ]
        );
        Categoria::create(
            [
                "idCategoria" => 10,
                "nome" => "Documentario"
            ]
        );
        Categoria::create(
            [
                "idCategoria" => 11,
                "nome" => "Guerra"
            ]
        );
        Categoria::create(
            [
                "idCategoria" => 12,
                "nome" => "Musical"
            ]
        );
        Categoria::create(
            [
                "idCategoria" => 13,
                "nome" => "Erotico"
            ]
        );
        Categoria::create(
            [
                "idCategoria" => 14,
                "nome" => "Storico"
            ]
        );
        Categoria::create(
            [
                "idCategoria" => 15,
                "nome" => "Fantascienza"
            ]
        );
        Categoria::create(
            [
                "idCategoria" => 16,
                "nome" => "Romantico"
            ]
        );
    }
}
