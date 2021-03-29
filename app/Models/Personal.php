<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $table = "personal";
    protected $fillable = ['name','last_name','nro_ci','date_nac','sex','direction','cargo','cel','state','user'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
