<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subgrupoexamen extends Model
{
    use HasFactory;
    protected $table = "subgrupoexamenes";
    protected $fillable = ['name','state','examen'];
    public function examen(){
        return $this->belongsTo(Examen::class);
    }
    public function valexamen(){
        return $this->hasMany(Valoresexamen::class,'subgrupoexamen','id');
     }
}
