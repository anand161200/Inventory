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
        return view('itams')->with(['brand'=> Brand::all()]);
    }

    public function itemList()
    {
        $brand_item = DB::table('items')
        ->select([
            'items.*',
            DB::raw("brands.name AS brand_name")
        ])
        ->join('brands', 'items.brand_id', '=', 'brands.id')
        ->get();

        $group_data = $brand_item->groupBy('brand_name');

        return response()->json([
            'itam' => $group_data
        ],200);
    }

    public function storeData(Request $request)
    {
       
        foreach($request->all_item as $data)
        {
            $item_data = new Items();
            $item_data->brand_id = $data['item_select'];
            $item_data->name = $data['item_name'];
            $item_data->price = $data['item_price'];
            $item_data->stock = $data['item_stock'];
            $item_data->save();
        }
        
    }
}
