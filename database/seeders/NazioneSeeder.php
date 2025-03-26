<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nazione;

class NazioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = storage_path("app/csv_db/nazioni.csv");
        // Definisce il percorso del file CSV contenente i dati delle nazioni, utilizzando il metodo `storage_path` per trovare il file nella directory storage.

        $file = fopen($csv, "r");
        // Apre il file CSV in modalità lettura ("r") e assegna il riferimento del file alla variabile `$file`.

        while (($data = fgetcsv($file, 200, ",")) !== false) {
            // Utilizza un ciclo while per leggere ogni riga del file CSV come array. La funzione `fgetcsv` legge fino a 200 caratteri per riga e utilizza la virgola (",") come delimitatore dei campi.
            // Il ciclo continua fino a quando non ci sono più righe da leggere (ossia, quando `fgetcsv` restituisce `false`).

            Nazione::create(
                // Crea un nuovo record nella tabella associata al modello "Nazione" con i dati letti dalla riga del file CSV.

                [
                    "idNazione" => $data[0],
                    // Assegna il primo campo del CSV (indice 0) alla colonna "idNazione" della tabella.

                    "nome" => $data[1],
                    // Assegna il secondo campo del CSV (indice 1) alla colonna "nome" della tabella.

                    "continente" => $data[2],
                    // Assegna il terzo campo del CSV (indice 2) alla colonna "continente" della tabella.

                    "iso" => $data[3],
                    // Assegna il quarto campo del CSV (indice 3) alla colonna "iso" della tabella.

                    "iso3" => $data[4],
                    // Assegna il quinto campo del CSV (indice 4) alla colonna "iso3" della tabella.

                    "prefissoTelefonico" => $data[5]
                    // Assegna il sesto campo del CSV (indice 5) alla colonna "prefissoTelefonico" della tabella.
                ]
            );
        }
    }
}
