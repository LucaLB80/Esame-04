<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ComuneItaliano;

class ComuneItalianoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = storage_path("app/csv_db/comuniItaliani.csv");
        // Definisce il percorso del file CSV contenente i dati delle nazioni, utilizzando il metodo `storage_path` per trovare il file nella directory storage.

        $file = fopen($csv, "r");
        // Apre il file CSV in modalità lettura ("r") e assegna il riferimento del file alla variabile `$file`.

        while (($data = fgetcsv($file, 200, ",")) !== false) {
            // Utilizza un ciclo while per leggere ogni riga del file CSV come array. La funzione `fgetcsv` legge fino a 200 caratteri per riga e utilizza la virgola (",") come delimitatore dei campi.
            // Il ciclo continua fino a quando non ci sono più righe da leggere (ossia, quando `fgetcsv` restituisce `false`).

            ComuneItaliano::create(
                // Crea un nuovo record nella tabella associata al modello "Nazione" con i dati letti dalla riga del file CSV.

                [
                    "idComune" => $data[0],
                    // Assegna il primo campo del CSV (indice 0) alla colonna "idComune" della tabella.

                    "comune" => $data[1],
                    // Assegna il secondo campo del CSV (indice 1) alla colonna "comune" della tabella.

                    "regione" => $data[2],
                    // Assegna il terzo campo del CSV (indice 2) alla colonna "regione" della tabella.

                    "provincia" => $data[3],
                    // Assegna il quarto campo del CSV (indice 3) alla colonna "provincia" della tabella.

                    "zona" => $data[4],
                    // Assegna il quinto campo del CSV (indice 4) alla colonna "zona" della tabella.

                    "sigla_provincia" => $data[5],
                    // Assegna il sesto campo del CSV (indice 5) alla colonna "sigla_provincia" della tabella.

                    "codice_istat" => $data[6],
                    // Assegna il settimo campo del CSV (indice 6) alla colonna "codice_istat" della tabella.

                    "abitanti" => $data[7],
                    // Assegna il ottavo campo del CSV (indice 7) alla colonna "abitanti" della tabella.

                    "superficie" => $data[8],
                    // Assegna il nono campo del CSV (indice 8) alla colonna "superficie" della tabella.

                    "cap" => $data[9],
                    // Assegna il decimo campo del CSV (indice 9) alla colonna "cap" della tabella.

                    "altitudine" => $data[10],
                    // Assegna il undicesimo campo del CSV (indice 10) alla colonna "altitudine" della tabella.

                    "popolazione_residente" => $data[11]
                    // Assegna il dodicesimo campo del CSV (indice 11) alla colonna "popolazione_residente" della tabella.
                ]
            );
        }
    }
}
