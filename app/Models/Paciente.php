<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $table = "pacientes";
    protected $fillable = ['name','last_name','nro_ci','date_nac','sex','direction','telephone','cel','state','cod_inst','user'];
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function insitucion()
    {
        return $this->belongsTo(Insitucion::class);
    }
    public function solicitud()
    {
        return $this->hasMany(Solicitud::class,'pacient','id');
    }
}
