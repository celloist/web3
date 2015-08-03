<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Product;
use App\Http\Models\Categorie;
use Validator;

class Products extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::all();

        return view('cms.products.overview', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->getProcessedCategories();
        
        return view('cms.products.create', ['categories' => $categories]);
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
            'category' => 'required',
            'name' => 'required|max:20',
            'artikelnr' => 'required|max:20',
            'price' => 'required|regex:/^\d*(\.\d{2})?$/',
            'vat' => 'required',
            'short_description' => 'required|min:10|max:255',
            'detail' => 'required|min:20'
        ]);
        
        if (!$validator->fails()) {
            $product = new Product();
            $product->Categories_id = $requestData['category'];
            $product->name = $requestData['name'];
            $product->artikelnr = $requestData['artikelnr'];
            $product->price = $requestData['price'];
            $product->vat = $requestData['vat'];
            $product->short_description = $requestData['short_description'];
            $product->detail = $requestData['detail'];

            if ($product->save()){
                return redirect()->route('beheer.products.index');
            } else {
                $validator->errors()->add('main', 'Er is een onbekende fout opgetreden tijdens het opslaan!');
            }
        }

        return redirect()->route('beheer.products.create')
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
        $validator = Validator::make($requestData, [
            'category' => 'required',
            'name' => 'required|max:20',
            'artikelnr' => 'required|max:20',
            'price' => 'required|regex:/^\d*(\.\d{2})?$/',
            'vat' => 'required',
            'short_description' => 'required|min:10|max:255',
            'image_small' => 'max:10000|mime:jpg,jpeg,png,gif',
            'image_large' => 'max:10000|mime:jpg,jpeg,png,gif',
            'detail' => 'required|min:20'
        ]);

        $product = Product::find($id);

        if (!$product){
            throw new Exception("Product not found!");
        }

        $categories = $this->getProcessedCategories();

        return view('cms.products.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $requestData = $request->all();
        $validator = $this->validator($requestData);


        if (!$validator->fails()) {
            $product = Product::find($id);
            if (!$product) {
                throw new Exception("Product not found!");
            } 

            $product->Categories_id = $requestData['category'];
            $product->name = $requestData['name'];
            $product->artikelnr = $requestData['artikelnr'];
            $product->price = $requestData['price'];
            $product->vat = $requestData['vat'];
            $product->short_description = $requestData['short_description'];
            $product->detail = $requestData['detail'];

            if ($product->save()){
                return redirect()->route('beheer.products.index');
            } else {
                $validator->errors()->add('main', 'Er is een onbekende fout opgetreden tijdens het opslaan!');
            }

        }

        return redirect()->route('beheer.products.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
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
    /**
     * Get all the current categories and return them in an [id=>name] format
     * 
     * @return [type] [description]
     */
    private function getProcessedCategories () {
        $parsedCategories = [];
        $categories = Categorie::all();
        foreach ($categories as $category) {
            $parsedCategories[$category->id] = $category->name;
        }

        return $parsedCategories;
    }
}
