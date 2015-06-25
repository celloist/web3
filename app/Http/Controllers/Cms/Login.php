<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Validator;
use Auth;
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
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            'username' => 'required|max:255',
            'password' => 'required',
        ]);


        if (!$validator->fails()) {
            if (Auth::attempt(['username' => $requestData['username'], 'password' => $requestData['password'], 'active' => 1])) {
                return redirect('/beheer/dashboard');     
            } else {
                $validator->errors()->add('all', 'Combinatie van gebruikersnaam en wachtwoord is onbekend!');
            }
        }

        return redirect()->route('cmsLoginGet')->withErrors($validator)
                                        ->withInput();

    }
}
