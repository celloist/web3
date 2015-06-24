<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Login extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view("login");
    }

    /**
     * Store a newly store resource in storage.
     *
     * @return Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:posts|max:255',
            'password' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect('cmsLogin')->withErrors($validator)
                                        ->withInput(); 
        } else {
            return redirect('dashboard');
        }

    }
}
