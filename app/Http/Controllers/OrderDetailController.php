<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\checkout;
use App\Models\Items;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderDetailController extends Controller
{
    
    public function checkoutPage()
    {
        return view('client_side.checkout'); 
    }

    public function checkout()
    {
       
        $all_cart = Cart::with('items')
        ->where('user_id', Auth::user()->id)
        ->get();

        $total = DB::table('cart')
        ->select([
            DB::raw('sum(cart.quantity * items.price) as total')
        ])
        ->join('items', 'cart.item_id', '=', 'items.id')
        ->where('user_id', Auth::user()->id)
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
        $chekout->user_id = Auth::user()->id;
        $chekout->first_name = $request->first_name;
        $chekout->last_name = $request->last_name;
        $chekout->email = $request->email;
        $chekout->address = $request->address;
        $chekout->zipcode = $request->zipCode;
        $chekout->contact = $request->contact;
        $chekout->amount = $request->amount;
        $chekout->save();

         
        $all_cart = Cart::with('items')
        ->where('user_id', Auth::user()->id)
        ->get();

        foreach ($all_cart as $cart) {

            $order = new OrderDetail();
            $order->item_id = $cart->item_id;
            $order->user_id = Auth::user()->id;
            $order->checkout_id = $chekout->id;
            $order->quantity = $cart->quantity;
            $order->save();  

            Cart::find($cart->id)->delete();
        }

       
        $vieworder = OrderDetail::with('orders')
        ->where('checkout_id',$chekout->id)
        ->where('user_id',Auth::user()->id)
        ->get();

         return view('client_side.thankyou')->with([
        'view_order' => $vieworder,

        ]);
       
    }  
    public function myorder()
    {
        $order_detail = DB::table('checkout')
        ->where('user_id',Auth::user()->id)
        ->orderBy('order_number','desc')
        ->get();

        return view('client_side.myorder')->with([
            'view_order' => $order_detail,
        ]);
    }

    public function MyOrderDetails($order_id)
    {
        $vieworder = OrderDetail::with('orderdetails')
        ->where('checkout_id',$order_id)
        ->where('user_id',Auth::user()->id)
        ->get();

        return view('client_side.order_details')->with([
            'order_detail' => $vieworder

        ]);
    }
}
