<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brands;

class BrandController extends Controller
{
    public function view_brand()
    {
        $data = Brands::orderby('id', 'desc')->get();
        return view('admin.brand', compact('data'));
    }


    public function add_brand(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
        ]);

        $data = new Brands();
        $data->brand_name = $request->brand;
        $data->save();

        return redirect()->back()->with('message', 'brand Added Successfully');
    }


    public function delete_brand($id)
    {
        $data = Brands::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('message', 'brand Deleted Successfully');
    }
}
