<?php

namespace Database\Seeders;

use App\Models\ContattoAbilita;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContattoAbilitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContattoAbilita::create([
            "nome" => "Leggere",
            "sku" => "leggere"

        ]);

        ContattoAbilita::create([
            'nome' => 'Creare',
            'sku' => 'creare',
        ]);

        ContattoAbilita::create([
            'nome' => 'Aggiornare',
            'sku' => 'aggiornare',
        ]);

        ContattoAbilita::create([
            'nome' => 'Eliminare',
            'sku' => 'eliminare',
        ]);
    }
}
