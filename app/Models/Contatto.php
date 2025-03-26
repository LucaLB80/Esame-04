<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ContattoRuolo;
use Illuminate\Foundation\Auth\User as Authenticable;


class Contatto extends Authenticable
{
    use HasFactory, SoftDeletes;
    protected $table = "contatti";
    protected $primaryKey = "idContatto";

    protected $fillable = [
        'idContattoStato',
        'nome',
        'cognome',
        'sesso',
        'codiceFiscale',
        'partitaIva',
        'cittadinanza',
        'idNazioneNascita',
        'cittaNascita',
        'provinciaNascita',
        'dataNascita',
        'archiviato',
        'created_by',
        'updated_by'

    ];
    // --------------------------------------------------------------------------------------------------------------------------------->
    // PUBLIC
    // --------------------------------------------------------------------------------------------------------------------------------->

    /**
     * Aggiungi i ruoli per il contatto sulla tabella contatti_contattiRuoli
     *
     * @param integer $idContatto
     * @param string|array $idRuoli
     * @return Collection
     */
    public static function aggiungiContattoRuoli($idContatto, $idRuoli)
    {
        $contatto = Contatto::where("idContatto", $idContatto)->firstOrFail();
        if (is_string($idRuoli)) {
            $tmp = explode(',', $idRuoli);
        } else {
            $tmp = $idRuoli;
        }

        $contatto->ruoli()->attach($tmp);
        return $contatto->ruoli;
    }
    // --------------------------------------------------------------------------------------------------------------------------------->

    // public function crediti()
    // {
    //     return $this->hasOne(ContattoCredito::class, 'idContatto', 'idContatto');
    // }
    // --------------------------------------------------------------------------------------------------------------------------------->

    /**
     * Elimina i ruoli per il contatto sulla tabella contatti_contattiRuoli
     *
     * @param integer $idContatto
     * @param string|array $idRuoli
     * @return Collection
     */
    public static function eliminaContattoRuoli($idContatto, $idRuoli)
    {
        $contatto = Contatto::where("idContatto", $idContatto)->firstOrFail();
        if (is_string($idRuoli)) {
            $tmp = explode(',', $idRuoli);
        } else {
            $tmp = $idRuoli;
        }

        $contatto->ruoli()->detach($tmp);
        return $contatto->ruoli;
    }
    // --------------------------------------------------------------------------------------------------------------------------------->
    // public function indirizzi()
    // {
    //     return $this->hasMany(ContattoIndirizzo::class, 'idContatto', 'idContatto')->orderBy("preferito", "DESC");
    // }
    // // --------------------------------------------------------------------------------------------------------------------------------->
    // public function recapiti()
    // {
    //     return $this->hasMany(ContattoRecapito::class, 'idContatto', 'idContatto')->orderBy("preferito", "DESC");
    // }

    // --------------------------------------------------------------------------------------------------------------------------------->
    public function ruoli()
    {
        return $this->belongsToMany(ContattoRuolo::class, 'contatti_contatti_ruoli', 'idContatto', 'idContattoRuolo');
    }
    // --------------------------------------------------------------------------------------------------------------------------------->
    /**
     * Sincronizza i ruoli per il contatto sulla tabella contatti_contattiRuoli
     *
     * @param integer $idContatto
     * @param string|array $idRuoli
     * @return Collection
     */
    public static function sinconizzaContattoRuoli($idContatto, $idRuoli)
    {
        $contatto = Contatto::where("idContatto", $idContatto)->firstOrFail();
        if (is_string($idRuoli)) {
            $tmp = explode(',', $idRuoli);
        } else {
            $tmp = $idRuoli;
        }
        $contatto->ruoli()->sync($tmp);
        return $contatto->ruoli;
    }
}
