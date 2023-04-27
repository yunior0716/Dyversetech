<?php

namespace App\Http\Controllers;

use App\Models\Operators;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller
{
    public function view_operator()
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $data = Operators::orderby('operator_id', 'desc')->get();

                return view('admin.operator', compact('data'));
            } else {

                return redirect('login');
            }
        } else {

            return redirect('login');
        }
    }


    public function add_operator(Request $request)
    {

        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $data = new Operators();

                $data->operator_name = $request->operator;


                $data->save();

                return redirect()->back()->with('message', 'operator Added Successfully');
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }



    public function delete_operator($id)
    {

        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $data = Operators::find($id);

                $data->delete();

                return redirect()->back()->with('message', 'operator Deleted Successfully');
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
}
