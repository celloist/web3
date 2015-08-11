<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    use SoftDeletes;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';
    protected $dates = ['deleted_at'];
    //
    public function products(){
        return $this->hasMany('Product');
    }
}
