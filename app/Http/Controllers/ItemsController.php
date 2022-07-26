<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    public function indexOfBrand()
    {
        
        return view('itams')->with([
            'brand'=> Brand::all()
        ]);
    }

    public function itemList()
    {
        $brands = Brand::with('items')->get();
         
        return response()->json([
            'itam' => $brands
        ],200);
    }

    // insert and update 
    public function storeUpadte(Request $request)
    {
        $request->validate(
            [
                'brand_id'=>'required',
                'all_item.*.item_name'=>'required|distinct',
                'all_item.*.item_price'=>'required',
                'all_item.*.item_stock'=>'required',
            ],
            [
                'brand_id.required'=>'The brand name field is required.',
                'all_item.*.item_name.required'=>'The item name field is required.',
                'all_item.*.item_name.distinct'=>'The item name field is duplicate.',
                'all_item.*.item_price.required'=>'The item price field is required.',
                'all_item.*.item_stock.required'=>'The item stock field is required.'
            ]
        );
            foreach($request->all_item as $data)
            {
                $item_data = $data['item_id'] !== null ? Items::find($data['item_id']) : new Items();
                $item_data->fill([
                    'brand_id'=>$request->brand_id,
                    'name'=>$data['item_name'],
                    'price'=>$data['item_price'],
                    'stock'=>$data['item_stock'],
                ])->save();
            }

        return response()->json([
            'Record add and update successfully'  
        ],200); 
    }
        // edit
    function itemDetails($id)
    {
       $all_item = Items::where('brand_id', $id)->get();
       $brand_name = Brand::find($id);
       
        return response()->json([
            'details'  => $all_item,
             'brand'   =>$brand_name
        ],200);

    }
    // delete
    function itemDelete($id)
    {
        $brand_name = Brand::find($id);
    
        $delete_item = Items::where('brand_id', $id)->get();

        foreach($delete_item as $data)
        {
           $data-> delete();
        }

        return response()->json([
            'item_data' =>  $brand_name
        ],200);
    }

    function itemedit($id)
    {
        $item = Items::find($id);
        $item->delete();

        return response()->json([
            'item' => $item
        ]);
    }


       // Client side data

    public function product()
    {
        return view('client_side.product'); 
    }

    public function shop()
    {
        $brand = Brand::withCount('items')->get();

        return view('client_side.shop')->with([   
            'brand_list' => $brand,
        ]); 
    }

    public function shopItem()
    {
        $item = Items::all();
        return response()->json([
            'item_data' =>  $item
        ],200);
    }

    public function viewItemDetails($id)
    {
        
        $viewItem = Items::where('id', $id)->first();

        return view('client_side.product')->with(['itemDetails'=> $viewItem]);
    }

    public function viewbrandDetails($brand_id)
    {
       $itemlist = Items::where('brand_id', $brand_id)->get();

        return response()->json([
            'item_name' =>  $itemlist
        ],200);
    }
}       
