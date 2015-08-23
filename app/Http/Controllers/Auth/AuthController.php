<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Group;
use App\Http\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Config;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    protected $redirectPath = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getRegister () {
        $countries = Config::get('static_values.countries');

        return view('auth.register', ['countries' => $countries]);
    }

    public function postLogin (Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!$validator->fails()) {
            if (!Auth::attempt(['username' => $data['username'], 'password' => $data['password']], isset($data['remember']))) {
                $validator->errors()->add('username', 'Unable to find a user with the provided username and password!');
            } else {
                return redirect('/');
            }
        }

        return redirect('login')
                        ->withErrors($validator)
                        ->withInput();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|min:4|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|max:255|email',
            'country' => 'required',
            'city' => 'required|max:255:min:2',
            'address' => 'required|max:255:min:3',
            'zip' => 'required|max:8:min:4',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $group =  Group::name('user')->first();

        if (!$group) {
            throw new Exception("Something went wrong!");
        }

        $data['group_id'] = $group['id'];
        $data['password'] = bcrypt($data['password']);

        
        return User::create($data);
    }
}
