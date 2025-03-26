<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContattoStato;

class ContattoStatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContattoStato::create(['nome' => 'Attivo']);
        ContattoStato::create(['nome' => 'In attesa']);
        ContattoStato::create(['nome' => 'Bannato']);
        ContattoStato::create(['nome' => 'Non attivo']);
    }
}
