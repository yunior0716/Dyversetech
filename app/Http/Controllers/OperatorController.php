<?php

namespace App\Http\Controllers;

use App\Models\Operators;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function view_operator()
    {
        $data = Operators::orderby('operator_id', 'desc')->get();
        return view('admin.operator', compact('data'));
    }


    public function add_operator(Request $request)
    {
        $request->validate([
            'operator' => 'required|string|max:255',
        ]);

        $data = new Operators();
        $data->operator_name = $request->operator;
        $data->save();

        return redirect()->back()->with('message', 'operator Added Successfully');
    }


    public function delete_operator($id)
    {
        $data = Operators::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('message', 'operator Deleted Successfully');
    }
}
