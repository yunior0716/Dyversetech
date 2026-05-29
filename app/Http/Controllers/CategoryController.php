<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function view_catagory()
    {
        $data = Catagory::orderby('id', 'desc')->get();
        return view('admin.catagory', compact('data'));
    }


    public function add_catagory(Request $request)
    {
        $request->validate([
            'catagory' => 'required|string|max:255',
        ]);

        $data = new Catagory;
        $data->catagory_name = $request->catagory;
        $data->save();

        return redirect()->back()->with('message', 'Catagory Added Successfully');
    }


    public function delete_catagory($id)
    {
        $data = Catagory::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('message', 'Catagory Deleted Successfully');
    }
}
