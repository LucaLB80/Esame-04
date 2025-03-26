<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContattoSessione extends Model
{
    use HasFactory;
    protected $table = "contatti_sessioni";
    protected $primaryKey = "idContattoSessione";

    protected $fillable = [
        'idContatto',
        'token',
        'inizioSessione'
    ];
    // ----------------------------------------- PUBLIC ----------------------------------------->
    //------------------------------------------------------------------------------------------->
    /**
     * Aggiorna la sessione per il contatto ed il token passato
     *
     * @param integer $idContatto
     * @param string $token
     */
    public static function aggiornaSessione($idContatto, $tk)
    {
        $where = ["idContatto" => $idContatto, "token" => $tk];
        $arr = ["inizioSessione" => time()];
        DB::table("contatti_sessioni")->updateOrInsert($where, $arr);
    }
    //------------------------------------------------------------------------------------------->
    /**
     * Elimina la sessione per il contatto passato
     *
     * @param integer $idContatto
     */
    public static function eliminaSessione($idContatto)
    {
        DB::table("contatti_sessioni")->where("idContatto", $idContatto)->delete();
    }
    //------------------------------------------------------------------------------------------->
    /**
     * Dati Sessione
     *
     * @param string $token
     * @return App\Models\ContattoSessione
     */
    public static function datiSessione($token)
    {
        if (ContattoSessione::esisteSessione($token)) {
            // return DB::table("contatti_Sessioni")->where("token", $token)->first();
            return ContattoSessione::where("token", $token)->get()->first();
        } else {
            return null;
        }
    }
    //------------------------------------------------------------------------------------------->
    /**
     * Controlla se esiste la sessione col token passato
     *
     * @param string $token
     * @return boolean
     */
    public static function esisteSessione($token)
    {
        return DB::table("contatti_sessioni")->where("token", $token)->exists();
    }
}
