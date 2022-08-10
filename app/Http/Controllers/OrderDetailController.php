<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\checkout;
use App\Models\Items;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderDetailController extends Controller
{
    
    public function checkoutPage()
    {
        return view('client_side.checkout'); 
    }

    public function checkout()
    {
        $all_cart = DB::table('cart')
        ->select([
            'cart.*',
            'items.name',
            'items.price',
            'items.stock',

        ])
        ->join('items', 'cart.item_id', '=', 'items.id')
        ->get();

        $total = DB::table('cart')
        ->select([
            DB::raw('sum(cart.quantity * items.price) as total')
        ])
        ->join('items', 'cart.item_id', '=', 'items.id')
        ->first();

        return response()->json([
            'cart_data' => $all_cart,
            'sub_total' => $total
        ],200);
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'zipCode' => 'required',
            'contact' => 'required'
        ]);

        $chekout = new checkout();
        $chekout->order_number = time();
        $chekout->first_name = $request->first_name;
        $chekout->last_name = $request->last_name;
        $chekout->email = $request->email;
        $chekout->address = $request->address;
        $chekout->zipcode = $request->zipCode;
        $chekout->contact = $request->contact;
        $chekout->amount = $request->amount;
        $chekout->save();

        $all_cart = DB::table('cart')
        ->select([
            'cart.*',
            'items.name',
            'items.price',
            'items.stock',

        ])
        ->join('items', 'cart.item_id', '=', 'items.id')
        ->get();

        foreach ($all_cart as $cart) {

            $order = new OrderDetail();
            $order->item_id = $cart->item_id;
            $order->checkout_id = $chekout->id;
            $order->quantity = $cart->quantity;
            $order->save();  

            Cart::find($cart->id)->delete();
        }

        
         //$update_stock= Cart::find($cart->item_id)->get();
        // $update_stock->stock = $cart->stock - $cart->quantity ;
        // $update_stock->save();

        return view('client_side.thankyou');
    }  

}
