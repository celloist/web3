<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Import\PhotoImportModel;
use Validator;

class Import extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getUploadZip()
    {
        return view('cms.import.uploadzip');
    }

    public function postUploadZip (Request $request) {
    	$validation = Validator::make($request->all(), [
    		'zip' => 'required|mimes:zip'
    	]);

    	if (!$validation->fails()) {
    		$photoImporter = new PhotoImportModel();
    		
    		if () {
                return redirect()->route('beheer.orders.index');
            } else {
                $validator->errors()->add('main', 'Er is een onbekende fout opgetreden tijdens het opslaan!');
            }
        }

        return redirect()->route('getUploadZip')
            ->withErrors($validator)
            ->withInput();
    }
}
