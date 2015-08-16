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
use Illuminate\Http\Request;

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

    public function addToShoppingcart(Request $request,$id)
    {
        $pCount = 0;
        $exists = false;
        $product = Product::findOrFail($id);
        //check is there is an array of products
        if ($product != null)
        {
            if(!$request->session()->has('products'))
            {
                $request->session()->put('products',array());
            }

            //returns shoppingcart
            $products = $request->session()->get('products');

            //checks if products already exists in shoppingcart and adds 1 if true
            foreach($products as $p)
            {
                if ($p['id'] == $product['id'])
                {
                    $exists = true;
                    $p['quantity']+=1;
                }
            }

            //adds a quantity var if it doesn't exist
           if(!$exists)
           {
               $product['quantity'] = 1;
               array_push($products,$product);
           }

       }
        $request->session()->put('products',$products);

        foreach($products as $p)
        {
            $count = $p['quantity'];
            $pCount += $count;
        }

        $request->session()->put('pCount',$pCount);

        return response()->json(['pCount'=>$pCount]);

    }

    public function shoppingcart(Request $request)
    {

        $shoppingcart = $request->session()->get('products');

        return view('customerPages.shoppingcart')->with('shoppingcart',$shoppingcart);
    }

    public function removeItem(Request $request,$id)
    {
        $product = Product::findOrFail($id);
        $newCart = array();
        $products = $request->session()->get('products');

        foreach($products as $p)
        {
            if ($p['id'] == $product['id'])
            {
                if($p['quantity'])
                {
                    --$p['quantity'];
                }
                if($p['quantity']> 0)
                {
                    array_push($newCart,$p);
                }
            }
        }

        $request->session()->put('products',$newCart);

        return response()->json(['succes'=>'succes']);
    }


}