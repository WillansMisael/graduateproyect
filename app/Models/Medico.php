<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;
    protected $table = "medicos";
    protected $fillable = ['name','last_name','sex','cel','state','speciality','user',];
    
    //
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function solicitud()
    {
        return $this->hasMany(Solicitud::class,'medic','id');
    }
}
