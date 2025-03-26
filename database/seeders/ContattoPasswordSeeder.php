<?php

namespace Database\Seeders;

use App\Models\ContattoPassword;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContattoPasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContattoPassword::create(
            [
                "idContatto" => 1,
                "psw" => hash("sha512", "Password123"),
                "sale" => hash("sha512", trim(Str::random(200)))

            ]
        );
        ContattoPassword::create(
            [
                "idContatto" => 2,
                "psw" => hash("sha512", "Password123"),
                "sale" => hash("sha512", trim(Str::random(200)))

            ]
        );
        ContattoPassword::create(
            [
                "idContatto" => 3,
                "psw" => hash("sha512", "Password123"),
                "sale" => hash("sha512", trim(Str::random(200)))

            ]
        );
    }
}
