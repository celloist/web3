<?php

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function categories(){
        return $this->hasOne('Categorie');
    }
}
