<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function view_catagory()
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $data = catagory::orderby('id', 'desc')->get();

                return view('admin.catagory', compact('data'));
            } else {

                return redirect('login');
            }
        } else {

            return redirect('login');
        }
    }


    public function add_catagory(Request $request)
    {

        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $data = new catagory;

                $data->catagory_name = $request->catagory;


                $data->save();

                return redirect()->back()->with('message', 'Catagory Added Successfully');
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }



    public function delete_catagory($id)
    {

        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $data = Catagory::find($id);

                $data->delete();

                return redirect()->back()->with('message', 'Catagory Deleted Successfully');
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
}
