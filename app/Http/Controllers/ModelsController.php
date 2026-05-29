<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Models;
use Illuminate\Http\Request;

class ModelsController extends Controller
{
    public function view_model()
    {
        $data = Models::with('brand')->orderby('model_id', 'desc')->get();
        $brand = Brands::orderby('id', 'desc')->get();

        return view('admin.model', compact(['data', 'brand']));
    }


    public function add_model(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|integer|exists:brands,id',
            'model' => 'required|string|max:255',
        ]);

        $data = new Models();
        $data->brand_id = $request->brand_id;
        $data->model_name = $request->model;
        $data->save();

        return redirect()->back()->with('message', 'model Added Successfully');
    }


    public function delete_model($id)
    {
        $data = Models::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('message', 'model Deleted Successfully');
    }
}
