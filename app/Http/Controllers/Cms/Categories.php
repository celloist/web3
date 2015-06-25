<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Categorie;
use Validator;

class Categories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Categorie::all();

        return view('cms.categories.overview', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            'name' => 'required|max:20',
        ]);


        if (!$validator->fails()) {
            $categorie = new Categorie();
            $categorie->name = $requestData['name'];

            if ($categorie->save()){
                return redirect()->route('beheer.categories.index');
            } else {
                $validator->errors()->add('main', 'Er is een onbekende fout opgetreden tijdens het opslaan!');
            }

        }

        return redirect()->route('beheer.categories.create')
                ->withErrors($validator)
                ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
