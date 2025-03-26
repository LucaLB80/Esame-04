<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ContattoAbilita;

class ContattoRuolo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contatti_ruoli';
    protected $primaryKey = 'idContattoRuolo';

    protected $fillable = [
        'nome',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function abilita()
    {
        return $this->belongsToMany(ContattoAbilita::class, 'contatti_ruoli_contatti_abilita', 'idContattoRuolo', 'idContattoAbilita');
    }
    // --------------------------------------------------------------------------------------------------------------------------------->
    /**
     * Aggiungi le abilità per il ruolo sulla tabella contattiRuoli_contattiAbilita
     *
     * @param integer $idCRuolo
     * @param string|array $idAbilita
     * @return Collection
     */
    public static function aggiungiRuoloAbilita($idRuolo, $idAbilita)
    {
        $ruolo = ContattoRuolo::where("idContattoRuolo", $idRuolo)->firstOrFail();
        if (is_string($idAbilita)) {
            $tmp = explode(',', $idAbilita);
        } else {
            $tmp = $idAbilita;
        }
        $ruolo->abilita()->attach($tmp);
        return $ruolo->abilita;
    }
}
