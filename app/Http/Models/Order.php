<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	/**
	 * [user description]
	 * @return [type] [description]
	 */
	public function user (){
        return $this->hasOne('App\Http\Models\User', 'id', 'Users_id');
    }
    /**
     * [rows description]
     * @return [type] [description]
     */
    public function rows () {
    	return $this->hasMany('App\Http\Models\Orderrow', 'Orders_id');
    }
    /**
     * 
     */
    public function scopeWithTotal ($query) {
        return $query->select('orders.*', DB::raw('DATE_FORMAT(orders.created_at, "%d/%c/%Y %H:%i") AS formatted_create_date'),DB::raw('DATE_FORMAT(orders.deliver_date, "%d/%c/%Y") AS formatted_deliver_date'), DB::raw('(SELECT SUM(orderrows.quantity * price) FROM orderrows WHERE orderrows.Orders_id = orders.id) AS total'));
    }
}
