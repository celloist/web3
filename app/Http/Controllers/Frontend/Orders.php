<?php
/**
 * @author Alhric Lacle <alhriclacle@gmail.com>
 * @project Web3
 * @created 24-Aug-15 4:52 PM
 */


namespace App\Http\Controllers\Frontend;

use App\Http\Models\Orderrow;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Order;
use Illuminate\Http\Request;

class Orders extends Controller
{

    public function checkOut()
    {
        return view('customerPages.checkout');
    }

    public function submit(Request $request)
    {

        $requestData = $request->all();
        $validator = $this->getValidator($requestData);

        if (!$validator->fails()) {

            $order = new Order();
            $order->firstname = $requestData['firstname'];
            $order->lastname = $requestData['lastname'];
            $order->adress = $requestData['adress'];
            $order->city = $requestData['city'];
            $order->zipcode = $requestData['zipcode'];
            $order->phonenr = $requestData['phonenr'];
            $order->email = $requestData['email'];
            $order->status = 'processing';
            $order->deliver_date = date('Y-m-d H:i:s');

            if ($order->save()){
               $cart = $request->session()->get('products');
                foreach($cart as $item)
                {
                    $row = new Orderrow();
                    $row->Order_id = $order->id;
                    $row->Products_id = $item['id'];
                    $row->quantity = $item['quantity'];
                    $row->price = $item['price'];
                    $row->vat = $item['vat'];

                    if(!$item->save())
                    {
                        $validator->errors()->add('main', 'Er is een onbekende fout opgetreden tijdens het opslaan!');
                        return redirect()->route('thankyou');
                    }
                }
                return redirect()->route('thankyou');
            } else {
                $validator->errors()->add('main', 'Er is een onbekende fout opgetreden tijdens het opslaan!');
            }
        }

        return redirect()->route('404')
        ->withErrors($validator)
        ->withInput();
    }



}