<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\Contatto;
use Illuminate\Support\Facades\DB;

class AppHelper
{

    //---PUBLIC------------------------------------------------------------------------------------------------------------>
    // -------------------------------------------------------------------------------------------------------------------->
    /**
     * Toglie il required alle rules di aggiornamento
     *
     * @param array $rules
     * @return array
     */
    public static function aggiornaRegoleHelper($rules)
    {
        $newRules = array();
        foreach ($rules as $key => $value) {
            $newRules[$key] = str_replace("required|", "", $value);
        }
        return $newRules;
    }
    // -------------------------------------------------------------------------------------------------------------------->
    /**
     * Unisci password e sale e fai HASH
     *
     * @param string $testo da cifrare
     * @param string $chiave usata per cifrare
     * @return string
     */
    public static function cifra($testo, $chiave)
    {
        $testoCifrato = AesCtr::encrypt($testo, $chiave, 256);
        return base64_encode($testoCifrato);
    }
    // -------------------------------------------------------------------------------------------------------------------->
    /**
     * Estrae i nomi dei campi della tabella sul DB
     *
     * @param array $tabella
     * @return array
     */
    public static function colonneTabellaDB($tabella)
    {
        $SQL = "SELECT COLUMN_NAME FROM information_schema.columns WHERE table_schema='" . DB::connection()->getDatabaseName() . "' AND table_name='" . $tabella . "';";
        $tmp = DB::select($SQL);
        return $tmp;
    }
    // -------------------------------------------------------------------------------------------------------------------->
    /**
     * Estrae i nomi dei campi della tabella sul DB
     *
     * @param string $password
     * @param string $sale
     * @param string $sfida
     * @return string
     */
    public static function creaPasswordCifrata($password, $sale, $sfida)
    {
        $hashPasswordESale = AppHelper::nascondiPassword($password, $sale);
        $hashFinale = AppHelper::cifra($hashPasswordESale, $sfida);
        return $hashFinale;
    }

    // -------------------------------------------------------------------------------------------------------------------->
    /**
     * Crea il token della sessione
     *
     * @param string $secretJWT come chiave di cifratura
     * @param integer $idContatto
     * @param integer $usaDa unixtime abilitazione uso token
     * @param integer $scade unixtime scadenza uso token
     * @return string
     */
    public static function creaTokenSessione($idContatto, $secretJWT, $usaDa = null, $scade = null)
    {
        $maxTime = 15 * 24 * 60 * 60; // il token scade sempre dopo 15gg max
        $recordContatto = Contatto::where("idContatto", $idContatto)->first();
        $t = time();
        $nbf = ($usaDa == null) ? $t : $usaDa;
        $exp = ($scade == null) ? $nbf + $maxTime : $scade;
        $ruolo = $recordContatto->ruoli[0];
        $idRuolo = $ruolo->idContattoRuolo;
        $abilita = $ruolo->abilita->toArray();
        $abilita = array_map(function ($arr) {
            return $arr["idContattoAbilita"];
        }, $abilita);

        $arr = array(
            "iss" =>  "https://www.bastaluca.it ",   // "https://www.codex.it", // "https://www.bastaluca.it"
            "aud" => null,
            "iat" => $t,
            "nbf" => $nbf,
            "exp" => $exp,
            "data" => array( // qui posso mettere qualsiasi valore
                "idContatto" => $idContatto,
                "idContattoStato" => $recordContatto->idContattoStato,
                "idContattoRuolo" => $idRuolo,
                "abilita" => $abilita,
                "nome" => trim($recordContatto->nome . " " . $recordContatto->cognome)
            )
        );
        // var_dump($secretJWT);
        $token = JWT::encode($arr, $secretJWT, 'HS256');
        return $token;
    }
    // -------------------------------------------------------------------------------------------------------------------->
    /**
     * Unisci password e sale e fai HASH
     *
     * @param string $testo da decifrare
     * @param string $chiave usata per decifrare
     * @return string
     */
    public static function decifra($testoCifrato, $chiave)
    {
        $testoCifrato = base64_decode($testoCifrato);
        return AesCtr::decrypt($testoCifrato, $chiave, 256);
    }
    // -------------------------------------------------------------------------------------------------------------------->
    /**
     * Controlla se è amministratore
     *
     * @param string $idGruppo
     * @return boolean
     */
    public static function isAdmin($idGruppo)
    {
        return ($idGruppo == 1) ? true : false;
    }
    // -------------------------------------------------------------------------------------------------------------------->
    /**
     * Unisci password e sale e fai HASH
     *
     * @param string $password
     * @param string $sale
     * @return string
     */
    public static function nascondiPassword($psw, $sale)
    {
        return hash("sha512", $sale . $psw);
    }
    // -------------------------------------------------------------------------------------------------------------------->
    /**
     * Restituisce un array di risposta personalizzata.
     *
     * @param boolean $successo TRUE se la richiesta è andata a buon fine
     * @param integer $codice STATUS CODE della richiesta
     * @param array   $dati    Dati richiesti
     * @param string  $messaggio   Messaggio facoltativo
     * @param array   $errori  Eventuali errori
     *
     * @return array
     */
    public static function rispostaCustom($dati, $msg = null, $err = null)
    {
        // Inizializza un array vuoto per contenere la risposta
        $response = array();

        // Imposta sempre la chiave "data" con il contenuto di $dati
        $response["data"] = $dati;

        // Se è presente un messaggio non nullo, aggiunge la chiave "message"
        if ($msg != null) {
            $response["message"] = $msg;
        }

        // Se sono presenti errori non nulli, aggiunge la chiave "error"
        if ($err != null) {
            $response["error"] = $err;
        }

        // Restituisce l'array di risposta
        return $response;
    }
    // -------------------------------------------------------------------------------------------------------------------->
    /**
     * Valida Token
     *
     * @param string $token
     * @param string $messaggio
     * @param array $errori
     * @return object
     */
    public static function validaToken($token, $secretJWT, $sessione)
    {
        $rit = null;
        $payload = JWT::decode($token, new Key($secretJWT, 'HS256'));
        // echo ("VALIDA 1<br>");
        if ($payload->iat <= $sessione->inizioSessione) {
            if ($payload->data->idContatto == $sessione->idContatto) {
                $rit = $payload;
                // echo ("VALIDA 2<br>");
            }
        }
        return $rit;
    }
}
