<?php
/**
 * @author Alhric Lacle <alhriclacle@gmail.com>
 * @project Web3
 * @created 24-Aug-15 5:22 PM
 */


namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Product;
use Illuminate\Http\Request;

class ShoppingCart extends Controller
{

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
        $state = 'Shoppingcart';
        if($shoppingcart == null)
        {
            $shoppingcart = array();
            $state = 'Shoppingcart is empty';
        }

        return view('customerPages.shoppingcart')->with('shoppingcart',$shoppingcart)->with('state',$state);
    }

    public function removeItem(Request $request,$id)
    {
        $product = Product::findOrFail($id);
        $newCart = array();
        $products = $request->session()->get('products');

        foreach ($products as $p) {
            if ($p['id'] == $product['id'])
            {
                $p['quantity'] = $p['quantity']-1;
            }

            if ($p['quantity'] > 0)
            {
                array_push($newCart, $p);
            }
        }

        $pCount = $request->session()->get('pCount');
        if($pCount >0)
        {
            $pCount = $pCount-1;
            $request->session()->put('pCount',$pCount);
        }

        $request->session()->put('products',$newCart);

        if(count($newCart)<1)
        {
            $state = 'Shoppingcart is empty';
        }
        else
        {
            $state = 'Shoppingcart';
        }

        return response()->json(['products'=>$newCart,'pCount'=>$pCount,'state'=>$state]);
    }

}