<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModelsController extends Controller
{
    public function view_model()
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $data = Models::with('brand')->orderby('model_id', 'desc')->get();
                $brand = Brands::orderby('id', 'desc')->get();

                return view('admin.model', compact(['data', 'brand']));


            } else {

                return redirect('login');
            }
        } else {

            return redirect('login');
        }
    }


    public function add_model(Request $request)
    {

        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $data = new Models();

                $data->brand_id = $request->brand_id;

                $data->model_name = $request->model;


                $data->save();

                return redirect()->back()->with('message', 'model Added Successfully');
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }



    public function delete_model($id)
    {

        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $data = Models::find($id);

                $data->delete();

                return redirect()->back()->with('message', 'model Deleted Successfully');
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
}
