<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function CartList()
    {
        return view('client_side.cart');
    }

    public function viewCart()
    {
        $all_cart = DB::table('cart')
        ->select([
            'cart.*',
            'items.name',
            'items.price'
        ])
        ->join('items', 'cart.item_id', '=', 'items.id')
        ->get();

        return response()->json([
            'cart_data' => $all_cart
        ],200);
    }

    public function addtoCart($item_id)
    {
        $card_details =Cart::where('item_id',$item_id)->get();

        if (count($card_details) > 0) {
            foreach ($card_details as $item) {
                $item->quantity = $item->quantity + 1;
                $item->save();
            }
        } else {
            $cart = new Cart();
            $cart->item_id = $item_id;
            $cart->current_date = Carbon::now();
            $cart->save();
        }

        return redirect()->route('CartList');
    }

    public function updateCart($item_id = null, $quantity = null)
    {
        DB::table('cart')->where('id', $item_id)->increment('quantity', $quantity);

        $all_cart = DB::table('cart')
        ->select([
            'cart.*',
            'items.name',
            'items.price'
        ])
        ->join('items', 'cart.item_id', '=', 'items.id')
        ->get();

        return response()->json([
            'cart_data' => $all_cart
        ],200);
        
    }

    public function deletecart($cart_id)
    {
        $delete_cart = Cart::find($cart_id);
        $delete_cart->delete();

        $all_cart = DB::table('cart')
        ->select([
            'cart.*',
            'items.name',
            'items.price'
        ])
        ->join('items', 'cart.item_id', '=', 'items.id')
        ->get();

        return response()->json([
            'cart_data' => $all_cart
        ],200);

    }
}
