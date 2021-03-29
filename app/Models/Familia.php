<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    use HasFactory;
   protected $table = 'familias';
   protected $fillable = ['name','description','state'];
   public function grupo(){
      return $this->hasMany(Grupo::class, 'familia','id');
   }
}
