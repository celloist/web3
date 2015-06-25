<?php
/**
 * @author Alhric Lacle <alhriclacle@gmail.com>
 * @project Web3
 * @created 24-Jun-15 3:31 PM
 */



namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Product;
use App\Http\Models\Category;

class Products extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($category_id)
    {
        $products = Product::where('Categories_id','=',$category_id)->get();
        $category = Categorie::findOrFail($category_id);
        $first = $products[rand(0,(count($products)-1))];


        return view('customerPages.products')->with('products',$products)->with('category',$category)->with('first',$first);
    }





}