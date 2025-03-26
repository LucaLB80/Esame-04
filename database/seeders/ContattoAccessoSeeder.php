<?php

namespace Database\Seeders;

use App\Models\ContattoAccesso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContattoAccessoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContattoAccesso::create(
            [
                "idContatto" => 1,
                "autenticato" => 1,
                "ip" => "::1"

            ]
        );
    }
}
