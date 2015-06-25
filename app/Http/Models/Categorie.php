<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';
    /**
     * Timestamps used to set the created and lastupdated 
     *
     * @var string
     */
    public $timestamps = false;
    //
    public function products(){
        return $this->hasMany('Product');
    }
}
