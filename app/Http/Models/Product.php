<?php

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];

    public function categories (){
        return $this->hasOne('App\Http\Models\Categorie', 'id', 'Categories_id');
    }

    public function scopeWhereCategory ($query, $id) {
    	return $query->where('Categories_id', $id);
    }
}
