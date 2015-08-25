<?php
/**
 * @author Alhric Lacle <alhriclacle@gmail.com>
 * @project Web3
 * @created 24-Jun-15 4:33 PM
 */

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Categorie;
use Illuminate\Support\Facades\Auth;

class Categories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Categorie::withProductThumb()->havingProducts()->get();
        return view('customerPages.categories')->with('categories',$data);
    }




}