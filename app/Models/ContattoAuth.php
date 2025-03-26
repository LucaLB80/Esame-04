<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ContattoAuth extends Model
{
    use HasFactory;
    protected $table = "contatti_auth";
    protected $primaryKey = "idContattoAuth";

    protected $fillable = [
        'idContatto',
        'user',
        'sfida',
        'secretJWT',
        'inizioSfida',
        'obbligoCambio'
    ];

    //---PUBLIC------------------------------------------------------------------------------------------------------------>
    // -------------------------------------------------------------------------------------------------------------------->

    /**
     * Controlla se esiste l'utente passato
     * 
     * @param string $utente
     * @return boolean
     */
    public static function esisteUtenteValidoPerLogin($user)
    {
        $tmp = DB::table('contatti')->join('contatti_auth', 'contatti.idContatto', '=', 'contatti_auth.idContatto')->where('contatti.idContattoStato', '=', 1)->where('contatti_auth.user', '=', $user)->select('contatti_auth.idContatto')->get()->count();
        return ($tmp > 0) ? true : false;
    }
    //--------------------------------------------------------------------------------------------------------------------->
    // -------------------------------------------------------------------------------------------------------------------->

    /**
     * Controlla se esiste l'utente passato
     * 
     * @param string $utente
     * @return boolean
     */
    public static function esisteUtente($user)
    {
        $tmp = DB::table('contatti_auth')->where('contatti_auth.user', '=', $user)->select('contatti_auth.idContatto')->get()->count();
        return ($tmp > 0) ? true : false;
    }
    //--------------------------------------------------------------------------------------------------------------------->
    // -------------------------------------------------------------------------------------------------------------------->
    /**
     * Crea un nuovo utente con username hashato, inizioSfida e secretJWT
     *
     * @param string $username
     * @return ContattoAuth
     */
    public static function creaUtente($username)
    {
        return self::create([
            'user' => Hash::make($username), // Hash dello username
            'inizioSfida' => now(), // Data e ora attuale
            'secretJWT' => Str::random(32) // Stringa casuale per il JWT
        ]);
    }
}
