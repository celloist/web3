<?php
/**
 * @author Alhric Lacle <alhriclacle@gmail.com>
 * @project Web3
 * @created 24-Jun-15 3:31 PM
 */



namespace App\Http\Controllers\Frontend;
use App\Http\Models\Categorie;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Product;
use Illuminate\Support\Facades\Response;

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
        if(count($products)<1)
        {
            return redirect()->route('categories');
        }
        $first = $products[rand(0,(count($products)-1))];


        return view('customerPages.products')->with('products',$products)->with('category',$category)->with('first',$first);
    }


    public function ajax($id)
    {
            $product = Product::findOrFail($id);
            return response()->json(['product'=>$product]);

    }
    public function searchProduct($value)
    {
        $products = DB::table('products')
        ->where('name', 'LIKE', '*'.$value.'*')
        ->OrWhere('detail', 'LIKE', '*'.$value.'*')
        ->get();
        return response()->json(['product'=>$products]);

    }





}