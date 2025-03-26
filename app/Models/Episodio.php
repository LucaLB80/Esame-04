<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episodio extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "episodi";
    protected $primaryKey = "idEpisodio";

    protected $fillable = [
        'idSerie',
        'titolo',
        'descrizione',
        'numeroStagione',
        'numeroEpisodio',
        'durata',
        'anno',
        'idImmagine',
        'idFilmato'
    ];

    public function categoria()
    {
        return $this->belongsTo(Serie::class, 'idSerie', 'idSerie');
    }
    //     Spiegazione dei parametri:

    //     Serie::class → è il nome del model collegato

    //     'idSerie' → è il nome della foreign key nella tabella film

    //     'idSerie' → è il nome della primary key nella tabella categorie
}
