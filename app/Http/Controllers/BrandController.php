<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brands;

class BrandController extends Controller
{
    public function view_brand()
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $data = Brands::orderby('id', 'desc')->get();

                return view('admin.brand', compact('data'));
            } else {

                return redirect('login');
            }
        } else {

            return redirect('login');
        }
    }


    public function add_brand(Request $request)
    {

        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $data = new Brands();

                $data->brand_name = $request->brand;


                $data->save();

                return redirect()->back()->with('message', 'brand Added Successfully');
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }



    public function delete_brand($id)
    {

        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $data = Brands::find($id);

                $data->delete();

                return redirect()->back()->with('message', 'brand Deleted Successfully');
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
}
