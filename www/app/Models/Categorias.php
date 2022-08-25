<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = "categorias";

    use HasFactory;

    protected $fillable = [
        'descricao_categoria'
    ];
}
