<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudDetails extends Model
{
    use HasFactory;
    protected $table = "solicitud_details";
    protected $fillable = ['solicitud','exam','grupo','subgrupo','valores','price','result','observation'];
    public function solicitud(){
        return $this->belongsTo(Solicitud::class);
    }
    public function examen(){
        return $this->hasMany(Examen::class);
    }

}
