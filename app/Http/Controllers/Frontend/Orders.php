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
use Validator;
use Mail;


class Orders extends Controller
{

    public function checkOut(Request $request)
    {
        $products = $request->session()->get('products');
        $user = $request->user();
        if($products != null && $products>0) {
            return view('customerPages.checkout')->with('user',$user);
        }
        return redirect()->route('categories');
    }

    public function sendMail()
    {

        return redirect()->route('thankyou');
    }
    public function submit(Request $request)
    {

        $requestData = $request->all();
        $validator = $this->getOrderValidator($requestData);

        if (!$validator->fails()) {

            $order = new Order();
            $order->firstname = $requestData['firstname'];
            $order->lastname = $requestData['lastname'];
            $order->adres = $requestData['adres'];
            $order->city = $requestData['city'];
            $order->zip = $requestData['zip'];
            $order->telephone = $requestData['telephone'];
            $order->email = $requestData['email'];
            $order->status = 'processing';
            $order->deliver_date = date('Y-m-d H:i:s');

            if ($order->save()){
               $cart = $request->session()->get('products');
                foreach($cart as $item)
                {
                    $row = new Orderrow();
                    $row->Orders_id = $order->id;
                    $row->Products_id = $item['id'];
                    $row->quantity = $item['quantity'];
                    $row->price = $item['price'];
                    $row->vat = $item['vat'];

                    if(!$row->save())
                    {
                        $validator->errors()->add('main', 'Er is een onbekende fout opgetreden tijdens het opslaan!');
                        return redirect()->route('checkoutPage')
                        ->withErrors($validator)
                        ->withInput();
                    }
                }

                $email = $requestData['email'];
                Mail::raw('Thank you for your purchase '.$order->firstname." ".$order->lastname." we will contact you shortly",['email'=>$email], function ($message) use ($email) {
                    $message->to($email);
                });

                $request->session()->put('products',array());
                $request->session()->forget('pCount');


                return redirect()->route('thankyou');
            } else {
                $validator->errors()->add('main', 'Er is een onbekende fout opgetreden tijdens het opslaan!');
            }
        }

        return redirect()->route('checkoutPage')
        ->withErrors($validator)
        ->withInput();
    }


    /**
     * [getValidator description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    private function getOrderValidator (array $requestData) {
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'adres' => 'required',
            'city' => 'required',
            'email' => 'required',
        ];


        return Validator::make($requestData, $rules);
    }

}