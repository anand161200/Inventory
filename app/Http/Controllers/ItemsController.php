<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    public function indexOfBrand()
    {
        return view('itams');
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
}
