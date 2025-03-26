<?php

namespace Database\Seeders;

use App\Models\ContattoContattoRuolo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContattoContattoRuoloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContattoContattoRuolo::create(
            [
                "idContatto" => 1,
                "idContattoRuolo" => 1
            ]
        );
        ContattoContattoRuolo::create(
            [
                "idContatto" => 2,
                "idContattoRuolo" => 2
            ]
        );
        ContattoContattoRuolo::create(
            [
                "idContatto" => 3,
                "idContattoRuolo" => 3
            ]
        );
    }
}
