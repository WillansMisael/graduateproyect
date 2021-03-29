<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = "solicitudes";
    protected $fillable = ['pacient','medic','total','attention','pago','state_pago','state_result','discount','solicitud_date'];
    
    
    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }
    public function medico(){
        return $this->belongsTo(Medico::class);
    }
    public function solicitud_details(){
        return $this->hasMany(SolicitudDetails::class, 'solicitud','id');
    }
   
}
