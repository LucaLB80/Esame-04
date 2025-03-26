<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Configurazione extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "configurazioni";
    protected $primaryKey = "idConfigurazione";

    protected $fillable = [
        'chiave',
        'valore'
    ];
    // public static function leggiValore($chiave)
    // {
    //     // Esegue una query sulla tabella 'configurazioni' cercando la riga con la chiave specificata.
    //     // Se trova una corrispondenza, restituisce direttamente il valore della colonna 'valore'.
    //     // Se la chiave non esiste nel database, restituisce null.
    //     return self::where('chiave', $chiave)->value('valore');
    // }

    //--- PUBLIC ------------------------------------------------------------------------------------------------
    // ----------------------------------------------------------------------------------------------------------
    /**
     * Ritorna il valore per la chiave passata se esiste
     *
     * @param string $chiave
     * @return string
     */
    public static function leggiValore($chiave)
    {
        $recordConfigurazione = Configurazione::where("chiave", $chiave)->first();
        return $recordConfigurazione["valore"];
    }
}
