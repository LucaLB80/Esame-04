<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RegistrazioneStoreRequest;
use App\Http\Requests\v1\RegistrazioneUpdateRequest;
use App\Models\ContattoAuth;
use App\Models\ContattoPassword;
use App\Models\ContattoAccesso;
use App\Models\ContattoSessione;
use App\Models\Configurazione;
use App\Models\Contatto;
use App\Models\ContattoContattoRuolo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;


class AccediController extends Controller
{

    //---PUBLIC------------------------------------------------------------------------------------------------------------>

    // -------------------------------------------------------------------------------------------------------------------->
    /**
     * Cerco l'hash dello user nel DB.
     * 
     * @param string $utente
     * @param string $hash
     * @return AppHelper\RitornoCustom
     */
    // public function searchMail($utente)
    // {
    //     $tmp = (ContattoAuth::esisteUtente($utente)) ? true : false;
    //     return AppHelper::rispostaCustom($tmp);
    // }

    // -------------------------------------------------------------------------------------------------------------------->

    /**
     * Punto di ingresso del login
     * 
     * @param string $utente
     * @param string $hash
     * @return AppHelper\RitornoCustom
     */
    public function show($utente, $hash = null)
    {

        if ($hash == null) {
            return AccediController::controlloUtente($utente);
        } else {
            return AccediController::controlloPassword($utente, $hash);
        }
    }
    // -------------------------------------------------------------------------------------------------------------------->


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    // -------------------------------------------------------------------------------------------------------------------->
    /**
     * Registra un nuovo utente creando i dati in più tabelle collegate:
     * - contatti
     * - contatti_auth
     * - contatti_password
     * - contatto_contatto_ruolo
     *
     * @param  \App\Http\Requests\v1\RegistrazioneStoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function registrazione(RegistrazioneStoreRequest $request)
    {
        DB::beginTransaction(); // Quando inizio una transazione con DB::beginTransaction() Tutte le query (insert(create), update, delete) vengono messe in pausa

        try {
            // 1. Salva il contatto
            $contatto = Contatto::create([
                'idContattoStato' => 1,
                'nome' => $request->nome,
                'cognome' => $request->cognome,
                'sesso' => null,
                'codiceFiscale' => null,
                'partitaIva' => null,
                'cittadinanza' => null,
                'idNazioneNascita' => null,
                'cittaNascita' => null,
                'provinciaNascita' => null,
                'dataNascita' => null,
                'archiviato' => 0,
                'created_by' => 1,
                'updated_by' => 1,
            ]);

            // 2. Salva i dati di auth
            ContattoAuth::create([
                'idContatto' => $contatto->idContatto,
                'user' => hash("sha512", $request->user),
                'sfida' => null,
                'secretJWT' => hash("sha512", trim(Str::random(200))),
                'inizioSfida' => time(),
                'obbligoCambio' => 0,
            ]);

            // // 3. Salva la password (con hash + salt)
            // $salt =  hash("sha512", trim(Str::random(200))),
            // $passwordHash = hash('sha256', $request->password . $salt);

            ContattoPassword::create([
                'idContatto' => $contatto->idContatto,
                'psw' => hash("sha512",  $request->psw),
                'sale' => hash("sha512", "ciao")
            ]);

            ContattoContattoRuolo::create([
                'idContatto' => $contatto->idContatto,
                'idContattoRuolo' => 2
            ]);

            DB::commit(); // Se va tutto bene le confermo con commit()

            return response()->json(['message' => 'Registrazione completata'], 201);
        } catch (\Exception $e) {
            DB::rollBack(); // Se qualcosa va male le annullo con rollBack()
            return response()->json(['error' => 'Errore nella registrazione', 'details' => $e->getMessage()], 500);
        }
    }
    // -------------------------------------------------------------------------------------------------------------------->
    /**
     * Modifica la password dell'utente autenticato
     *
     * @param  \App\Http\Requests\v1\RegistrazioneUpdateRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function modificaPassword(RegistrazioneUpdateRequest $request)
    {
        DB::beginTransaction();

        try {
            $utente = Auth::user(); // Recupero l'utente loggato

            ContattoPassword::where('idContatto', $utente->idContatto)->update([
                'psw' => hash("sha512", $request->psw),
                'sale' => hash("sha512", "ciao")
            ]);
            DB::commit(); // Se va tutto bene le confermo con commit()

            return response()->json(['message' => 'Modifica completata'], 201);
        } catch (\Exception $e) {
            DB::rollBack(); // Se qualcosa va male le annullo con rollBack()            
            return response()->json(['error' => 'Errore nella modifica della password', 'details' => $e->getMessage()], 403);
        }
    }
    // -------------------------------------------------------------------------------------------------------------------->

    /**
     * Effettua il logout dell'utente autenticato.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Logout effettuato con successo']);
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // ----------------------------------------------------------------------------------------------------------------------->
    /**
     * Verifica il token ad ogni chiamata
     *
     * @param string $token
     * @return object
     */
    public static function verificaToken($token)
    {
        $rit = null;

        $sessione = ContattoSessione::datiSessione($token);
        if ($sessione != null) {

            $inizioSessione = $sessione->inizioSessione;
            $durataSessione = Configurazione::leggiValore('durataSessione');
            $scadenzaSessione = $inizioSessione + $durataSessione;
            // echo ("PUNTO 1<br>");
            if (time() < $scadenzaSessione) {
                // echo ("PUNTO 2<br>");
                $auth = ContattoAuth::where('idContatto', $sessione->idContatto)->first();
                if ($auth != null) {
                    // echo ("PUNTO 3<br>");
                    $secretJWT = $auth->secretJWT;
                    $payload = AppHelper::validaToken($token, $secretJWT, $sessione);
                    if ($payload != null) {
                        // echo ("PUNTO 4<br>");
                        $rit = $payload;
                    } else {
                        abort(403, 'TK_0006');
                    }
                } else {
                    abort(403, 'TK_0005');
                }
            } else {
                abort(403, 'TK_0004 | Sessione scaduta');
            }
        } else {
            abort(403, 'TK_0003 | Non hai i privilegi necessari per eseguire questa azione ');
        }
        return $rit;
    }
    //---PROTECTED------------------------------------------------------------------------------------------------------------>
    // ----------------------------------------------------------------------------------------------------------------------->

    /**
     * Controllo validità utente
     *
     * @param string $utente
     * @return AppHelper\rispostaCustom
     */
    protected static function controlloUtente($utente)
    {

        // $sfida = hash("sha512", trim(Str::random(200))); 

        // $sale = hash("sha512", trim(Str::random(200))); // DA USARE DOPO IL CONTROLLO POSITIVO DEL LOGIN
        $sale = hash("sha512", "ciao"); // DA CAMBIARE DOPO IL CONTROLLO POSITIVO DEL LOGIN
        if (ContattoAuth::esisteUtenteValidoPerLogin($utente)) {
            //esiste
            $auth = ContattoAuth::where('user', $utente)->first();
            // $auth->sfida = $sfida;
            $auth->secretJWT = hash("sha512", trim(Str::random(200)));
            $auth->inizioSfida = time();
            $auth->save();
            $recordPassword = ContattoPassword::passwordAttuale($auth->idContatto);
            $recordPassword->sale = $sale;
            $recordPassword->save();
        } else {
            // non esiste, quindi invento sfida e sale per confondere le idee
        }
        // $dati = array("sfida" => $sfida, "sale" => $sale);
        $dati = array("sale" => $sale);
        return AppHelper::rispostaCustom($dati);
    }
    // -------------------------------------------------------------------------------------------------------------------->
    /**
     * Punto di ingresso del login
     *
     * @param string $utente
     * @param string $hash
     * @return AppHelper\rispostaCustom
     */
    protected static function controlloPassword($utente, $hashClient)
    {
        if (ContattoAuth::esisteUtenteValidoPerLogin($utente)) {
            //esiste
            $auth = ContattoAuth::where("user", $utente)->first();
            //$sfida = $auth->sfida;
            $secretJWT = $auth->secretJWT;
            // var_dump($secretJWT);
            $inizioSfida = $auth->inizioSfida;
            $durataSfida = Configurazione::leggiValore("durataSfida");
            $maxTentativi = Configurazione::leggiValore("maxLoginErrati");
            $scadenzaSfida = $inizioSfida + $durataSfida;
            if (time() < $scadenzaSfida) {
                // var_dump("Dentro l'IF");
                $tentativi = ContattoAccesso::contaTentativi($auth->idContatto);
                if ($tentativi < $maxTentativi - 1) {
                    // proseguo
                    $recordPassword = ContattoPassword::passwordAttuale($auth->idContatto);

                    $password = $recordPassword->psw;
                    $sale = $recordPassword->sale;
                    // $hashFinaleDB = AppHelper::creaPasswordCifrata($password, $sale, $sfida);
                    $passwordNascostaDB = AppHelper::nascondiPassword($password, $sale);
                    // var_dump("hashClient", $hashClient);
                    // var_dump("passwordNascostaDB", $passwordNascostaDB);

                    //$passwordClient = AppHelper::decifra($hashClient, $secretJWT);
                    if ($hashClient == $passwordNascostaDB) {
                        //login corretto quindi creo token

                        $tk = AppHelper::creaTokenSessione($auth->idContatto, $secretJWT);
                        // echo ("Test");
                        ContattoAccesso::eliminaTentativi($auth->idContatto);
                        $accesso = ContattoAccesso::aggiungiAccesso($auth->idContatto);

                        ContattoSessione::eliminaSessione($auth->idContatto);
                        ContattoSessione::aggiornaSessione($auth->idContatto, $tk);

                        $dati = array("tk" => $tk);
                        return AppHelper::rispostaCustom($dati);
                    } else {
                        ContattoAccesso::aggiungiTentativoFallito($auth->idContatto);
                        abort(403, "ERR L004");
                    }
                } else {
                    abort(403, "ERR L003");
                }
            } else {
                // var_dump("Dentro l'ELSE L002");
                ContattoAccesso::aggiungiTentativoFallito($auth->idContatto);
                abort(403, "ERR L002");
            }
        } else {
            abort(403, "ERR L001");
        }
    }


    // --------FATTO DA RINO IN CHIAMATA--------------------------------------------------------------------------------------------------
    /** // COMMENTARE DOPO IL CONTROLLO POSITIVO DEL LOGIN
     * Crea il token per sviluppo
     *
     * @param string $utente
     * @return AppHelper\rispostaCustom
     */
    public static function testLogin($hashUtente, $hashPassword)
    {
        if (ContattoAuth::esisteUtenteValidoPerLogin($hashUtente)) {
            // echo ("Test");
            //esiste
            $auth = ContattoAuth::where('user', $hashUtente)->first();
            //$auth->sfida = $sfida;
            $auth->secretJWT = hash("sha512", trim(Str::random(200)));
            $auth->inizioSfida = time();
            $auth->save();
        }

        print_r(AccediController::controlloPassword($hashUtente, $hashPassword));
    }
}
