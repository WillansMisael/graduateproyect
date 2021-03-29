<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoresexamen extends Model
{
    use HasFactory;
    protected $table = "valoresexamenes";
    protected $fillable = ['subgrupoexamen','unidad','name','rango_normal','state'];

    public function unidad()
    {
        return $this->hasMany(Unidad::class);
    }
    public function subgrupoexamen(){
        return $this->belongsTo(Subgrupoexamen::class);
    }
}
