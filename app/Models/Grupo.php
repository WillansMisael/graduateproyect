<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $table = "grupos";
    protected $fillable = ['name','state','familia'];
    public function familia(){
        return $this->belongsTo(Familia::class);
    }
    public function examen(){
        return $this->hasMany(Examen::class,'grupo','id');
     }
}
