<?php

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public function categories(){
        return $this->hasOne('Categorie');
    }
}
