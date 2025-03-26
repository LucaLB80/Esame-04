<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContattoRuoloContattoAbilita extends Model
{
    use HasFactory;
    protected $table = 'contatti_ruoli_contatti_abilita';

    protected $fillable = [
        'idContattoAbilita',
        'idContattoRuolo',
    ];
}
