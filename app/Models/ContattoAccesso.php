<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContattoAccesso extends Model
{
    use HasFactory;
    protected $table = "contatti_accessi";
    protected $primaryKey = "id";

    protected $fillable = [
        'idContatto',
        'autenticato',
        'ip'
    ];
    //--- PUBLIC ------------------------------------------------------------------------>
    //----------------------------------------------------------------------------------->
    /**
     * Aggiungi tentativo fallito per l'idContatto
     *
     * @param string $idContatto
     */
    public static function aggiungiAccesso($idContatto)
    {
        ContattoAccesso::eliminaTentativi($idContatto);
        return ContattoAccesso::nuovoRecord($idContatto, 1);
    }
    //----------------------------------------------------------------------------------->
    /**
     * Aggiungi tentativo fallito per l'idContatto
     *
     * @param string $idContatto
     */
    public static function aggiungiTentativoFallito($idContatto)
    {
        return ContattoAccesso::nuovoRecord($idContatto, 0);
    }
    //----------------------------------------------------------------------------------->
    /**
     * Conta quanti tentativi per l'idContatto sono registrati
     *
     * @param string $idContatto
     * @return integer
     */
    public static function contaTentativi($idContatto)
    {
        $tmp = ContattoAccesso::where("idContatto", $idContatto)->where("autenticato", 0)->count();
        return $tmp;
    }
    //----------------------------------------------------------------------------------->
    /**
     * Elimina solo i tentativi falliti (autenticato = 0) per un determinato idContatto
     *
     * @param string $idContatto
     * @return void
     */
    public static function eliminaTentativi($idContatto)
    {
        ContattoAccesso::where("idContatto", $idContatto)
            ->where("autenticato", 0)
            ->delete();
    }

    //----------------------------------------------------------------------------------->
    //-- PROTECTED ---------------------------------------------------------------------->

    /**
     * Conta quanti tentativi per l'idContatto sono registrati
     *
     * @param string $idContatto
     * @param boolean $autenticato
     * @return App\Models\Accesso
     */
    protected static function nuovoRecord($idContatto, $autenticato)
    {
        $tmp = ContattoAccesso::create([
            "idContatto" => $idContatto,
            "autenticato" => $autenticato,
            "ip" => request()->ip()
        ]);
        return $tmp;
    }
}
