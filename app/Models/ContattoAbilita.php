<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContattoAbilita extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "contatti_abilita";
    protected $primaryKey = 'idContattoAbilita';

    protected $fillable = [
        'nome',
        'sku',
    ];
}
