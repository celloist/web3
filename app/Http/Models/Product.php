<?php

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];

    public function categories(){
        return $this->hasOne('Categorie');
    }
}
