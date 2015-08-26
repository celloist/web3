<?php

namespace App\Http\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword;
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['group_id','username', 'password', 'email', 'name', 'lastname', 'country', 'city', 'address', 'zip'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the group associated with the user.
     */
    public function group()
    {
        return $this->hasOne('App\Http\Models\Group', 'id', 'group_id');
    }
    /**
     * [hasRole description]
     * @param  array   $roles [description]
     * @return boolean        [description]
     */
    public function hasRole (array $roles = array()) {
        if ($this->group != null){
            return in_array($this->group["name"], $roles);
        }

        return false;
    }

    public function scopeWithUsernameLike ($query, $username) {
        return $query->where('username', 'LIKE', '%'. $username .'%');
    }
}
