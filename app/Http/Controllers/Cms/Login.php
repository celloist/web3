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
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function post()
    {
        //
    }
}
