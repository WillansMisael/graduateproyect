<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;
    protected $table = "unidades";
    protected $fillable = ['description','unit','state'];
    
    public function valoresexamen()
   {
       return $this->belongsTo(Valoresexamen::class,'unidad');
   }
}
