<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichierExcel extends Model
{
    use HasFactory;
    protected $fillable =['id','nom','url','nomFichier','date'];
    protected $table = 'fichierExcel';
}
