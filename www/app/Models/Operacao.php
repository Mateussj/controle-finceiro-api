<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operacao extends Model
{
    protected $table = "operacoes";

    use HasFactory;

    protected $fillable = [
        'valor',
        'titulo',
        'data_da_operacao',
        'categoria_id'
    ];
}
