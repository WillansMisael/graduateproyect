<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;
    protected $table = 'examenes';
    protected $fillable = ['id','name','method','price_normal','price_emergency','state','grupo'];
    
   
    public function solicitud(){
        return $this->belongsToMany(Solicitud::class);
    }
    
     public function grupo(){
        return $this->belongsTo(Grupo::class);
    }
    public function subgrupo(){
        return $this->hasMany(Subgrupoexamen::class,'examen','id');
     }
     public function solicitud_details(){
        return $this->hasMany(SolicitudDetails::class, 'solicitud','id');
    }
}
