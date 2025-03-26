<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContattoContattoRuolo extends Model
{
    use HasFactory;

    protected $table = 'contatti_contatti_ruoli';

    protected $fillable = [
        'idContatto',
        'idContattoRuolo'
    ];
}
