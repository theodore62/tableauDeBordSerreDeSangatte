<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantes extends Model
{
    use HasFactory;
    protected $fillable =['id','nom', 'varieter','couleur','conditionnement','prix','categorie'];
    protected $table = 'plantes';
}
