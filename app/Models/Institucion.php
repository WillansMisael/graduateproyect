<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
   use HasFactory;
   // en el caso que la tabla se llame distinto aqui especificar
   protected $table = 'instituciones';
   protected $fillable = ['name','telephone','state','direction','email'];
   public function pacientes()
   {
       return $this->hasMany(Paciente::class,'cod_inst','id');
   }
}
