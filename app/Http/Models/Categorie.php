<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class categorie extends Model
{
    public function products(){
        return $this->hasMany('Product');
    }
}
