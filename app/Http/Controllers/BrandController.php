<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandFromRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function indexOfBrand()
    {
        return view('brand');
    }

    public function brandList()
    {
        return response()->json([
            'brand' => Brand::all()
        ],200);
    }

    function brandDetails($id)
    {
        $brand_name= Brand::find($id);
        return response()->json([
            'details'  => $brand_name
        ],200); 
    }
   
    function addOrupdate(BrandFromRequest $request)
    {
        $brand = $request->id !== null ? Brand::find($request->id) : new Brand();
        $brand->fill($request->getRequestFiled())->save();

        return response()->json([
            'Record add and update successfully'  
        ],200);
    }

    public function deleteBrand(Request $request)
    {
        $deleterecord=Brand::find($request->brand_id);
        $deleterecord->delete();

        return response()->json([
            'data' => $deleterecord 
        ],200);
    }
}
