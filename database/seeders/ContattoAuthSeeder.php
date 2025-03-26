<?php

namespace Database\Seeders;

use App\Models\ContattoAuth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContattoAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContattoAuth::create(
            [
                'idContatto' => 1,
                'user' => hash("sha512", "utente1"),
                'sfida' => '',
                'secretJWT' => hash("sha512", trim(Str::random(200))),
                'inizioSfida' => time(),
                'obbligoCambio' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        ContattoAuth::create(
            [
                'idContatto' => 2,
                'user' => hash("sha512", "utente2"),
                'sfida' => '',
                'secretJWT' => hash("sha512", trim(Str::random(200))),
                'inizioSfida' => time(),
                'obbligoCambio' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        ContattoAuth::create(
            [
                'idContatto' => 3,
                'user' => hash("sha512", "utente3"),
                'sfida' => '',
                'secretJWT' => hash("sha512", trim(Str::random(200))),
                'inizioSfida' => time(),
                'obbligoCambio' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
