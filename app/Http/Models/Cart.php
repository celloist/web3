<?php

namespace App\Http\Models;


class Cart
{
    protected $products = array();
    protected $count = 0;
    protected $total = 0;

    public function addItem (Product $product) {
        //check is there is an array of products
        if ($product != null) {
            if (array_key_exists($product->id, $this->products)) {
                $this->updateQuantity($product, ($this->products[$product->id]['quantity'] +1));
            } else {
                $this->products[$product->id] = $product;
                $this->updateQuantity($product, 1);
            }

            $this->calcTotals();
        }
    }
    
    public function removeItem (Product $product) {
        if (array_key_exists($product->id, $this->products)){
            $oldProduct = $this->products[$product->id];
            unset($this->products[$product->id]);

            $this->calcTotals();
        }
    }
    
    public function updateQuantity (Product $product, $quantity) {
        if (array_key_exists($product->id, $this->products)) {
            $product['quantity'] = $quantity;
            $product['subtotal'] = $quantity * $product['price'];
            $this->products[$product->id] = $product;

            $this->calcTotals();
        }
    }

    private function calcTotals () {
        $this->count = 0;
        $this->total = 0;
        foreach ($this->products as $product) {
            $this->count+= $product['quantity'];
            $this->total+= $product['subtotal'];
        }
        
    }

    public function getItems () {
        return $this->products;
    }

    public function getCount () {
        return $this->count;
    }

    public function getTotal () {
        return $this->total;
    }
}
