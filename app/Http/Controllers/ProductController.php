<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Catagory;
use App\Models\Characteristics;
use App\Models\Comment;
use App\Models\Filters;
use App\Models\Models;
use App\Models\Operators;
use App\Models\Phones_Characteristics;
use App\Models\Product;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function view_product()
    {
        $models = Models::orderByDesc('model_id')->get();
        $operators = Operators::orderByDesc('operator_id')->get();
        $catagory = Catagory::orderby('id', 'desc')->get();
        $characteristics = Characteristics::all();

        return view('admin.product', compact(['catagory', 'models', 'operators', 'characteristics']));
    }


    public function add_product(Request $request)
    {
        $request->validate([
            'model_id' => 'required|integer|exists:models,model_id',
            'operator_id' => 'required|integer|exists:operators,operator_id',
            'description' => 'required|string|max:2000',
            'price' => 'required|numeric|min:0|max:999999.99',
            'quantity' => 'required|integer|min:0|max:10000',
            'dis_price' => 'nullable|numeric|min:0|max:999999.99',
            'catagory' => 'required|string|max:255',
            'condition' => 'required|string|max:100',
            'imei' => 'nullable|string|max:20',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'characteristics' => 'nullable|array',
            'characteristics.*' => 'nullable|string|max:255',
        ]);

        $product = new Product;
        $product->model_id = $request->model_id;
        $product->operator_id = $request->operator_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->dis_price;
        $product->catagory = $request->catagory;
        $product->condition = $request->condition;
        $product->imei = $request->imei;

        $image = $request->image;
        $imagename = time() . '_' . Str::random(8) . '.' . $image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image = $imagename;

        $product->save();

        if ($request->has('characteristics')) {
            foreach ($request->input('characteristics') as $characteristic_id => $characteristic_value) {
                $product->phoneCharacteristics()->create([
                    'characteristic_id' => $characteristic_id,
                    'characteristic_value' => $characteristic_value,
                ]);
            }
        }

        return redirect()->back()->with('message', 'Product Added Successfullly');
    }


    public function show_product()
    {
        $product = Product::with(['model', 'phoneCharacteristics.characteristic'])->orderby('id', 'desc')->get();
        return view('admin.show_product', compact('product'));
    }


    public function delete_product($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }


    public function update_product($id)
    {
        $product = Product::with('phoneCharacteristics.characteristic')->findOrFail($id);
        $catagory = Catagory::all();
        $models = Models::with('brand')->get();
        $operators = Operators::all();
        $characteristics = Characteristics::all();

        return view('admin.update_product', compact('product', 'catagory', 'models', 'operators', 'characteristics'));
    }

    public function update_product_confirm(Request $request, $id)
    {
        $request->validate([
            'model_id' => 'required|integer|exists:models,model_id',
            'operator_id' => 'required|integer|exists:operators,operator_id',
            'description' => 'required|string|max:2000',
            'price' => 'required|numeric|min:0|max:999999.99',
            'quantity' => 'required|integer|min:0|max:10000',
            'dis_price' => 'nullable|numeric|min:0|max:999999.99',
            'catagory' => 'required|string|max:255',
            'condition' => 'required|string|max:100',
            'imei' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'characteristics' => 'nullable|array',
            'characteristics.*' => 'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($id);

        $product->model_id = $request->model_id;
        $product->operator_id = $request->operator_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->catagory = $request->catagory;
        $product->quantity = $request->quantity;
        $product->condition = $request->condition;
        $product->imei = $request->imei;

        $image = $request->image;

        if ($image) {
            $imagename = time() . '_' . Str::random(8) . '.' . $image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }

        $product->save();

        if ($request->has('characteristics')) {
            foreach ($request->input('characteristics') as $characteristic_id => $characteristic_value) {
                $phoneCharacteristic = $product->phoneCharacteristics->where('characteristic_id', $characteristic_id)->first();

                if ($phoneCharacteristic) {
                    $phoneCharacteristic->characteristic_value = $characteristic_value;
                    $phoneCharacteristic->save();
                } else {
                    $product->phoneCharacteristics()->create([
                        'characteristic_id' => $characteristic_id,
                        'characteristic_value' => $characteristic_value,
                    ]);
                }
            }
        }

        return redirect()->back()->with('message', 'Product Updated Successfully');
    }



    public function search_product(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'filter_ids' => 'nullable|array',
            'filter_ids.*' => 'integer',
        ]);

        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        $filters = Filters::all();
        $cart_count = 0;

        if (Auth::id()) {
            $user_id = Auth::user()->id;
            $cart_count = Cart::where('user_id', '=', $user_id)->count();
        }

        $search_text = $request->search;
        $filter_ids = $request->input('filter_ids');

        if ($filter_ids) {
            $selected_filters = Filters::whereIn('filter_id', $filter_ids)->get();
        } else {
            $found_filter = Filters::where('filter_name', 'LIKE', '%' . $search_text . '%')->first();
            $selected_filters = $found_filter ? collect([$found_filter]) : collect([]);
        }

        if (count($selected_filters) > 0) {
            $query = Product::query();

            foreach ($selected_filters as $filter) {
                $filter->load('characteristics');
                foreach ($filter->characteristics as $characteristic) {
                    $query->whereHas('characteristics', function ($q) use ($characteristic) {
                        $q->where('characteristics.characteristics_id', $characteristic->pivot->characteristic_id)
                          ->whereBetween(DB::raw('CAST(phones_characteristics.characteristic_value AS DECIMAL(10,2))'), [$characteristic->pivot->min_value, $characteristic->pivot->max_value]);
                    });
                }

                if ($filter->min_price !== null && $filter->max_price !== null) {
                    $query->whereBetween('price', [$filter->min_price, $filter->max_price]);
                }
            }

            $product = $query->paginate(10);
        } else {
            $product = Product::whereHas('model', function ($query) use ($search_text) {
                $query->where('model_name', 'LIKE', "%$search_text%")->orWhereHas('brand', function ($query) use ($search_text) {
                    $query->where('brand_name', 'LIKE', "%$search_text%");
                });
            })
            ->orWhere('catagory', 'LIKE', "%$search_text%")
            ->paginate(10);
        }

        return view('home.all_product', compact('product', 'comment', 'reply', 'cart_count', 'filters'));
    }


    public function product_search(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        $filters = Filters::all();
        $serach_text = $request->search;

        $product = Product::whereHas('model', function ($query) use ($serach_text) {
            $query->where('model_name', 'LIKE', "%$serach_text%")->orWhereHas('brand', function ($query) use ($serach_text) {
                $query->where('brand_name', 'LIKE', "%$serach_text%");
            });
        })->paginate(10);

        if (Auth::id()) {
            $user_id = Auth::user()->id;
            $cart_count = Cart::where('user_id', '=', $user_id)->count();
            return view('home.userpage', compact('product', 'comment', 'reply', 'cart_count', 'filters'));
        }

        return view('home.userpage', compact('product', 'comment', 'reply', 'filters'));
    }

    public function product()
    {
        $product = Product::with('model.brand')->paginate(9);
        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        $filters = Filters::all();

        if (Auth::id()) {
            $user_id = Auth::user()->id;
            $cart_count = Cart::where('user_id', '=', $user_id)->count();
            return view('home.all_product', compact('product', 'comment', 'reply', 'cart_count', 'filters'));
        }

        return view('home.all_product', compact('product', 'comment', 'reply', 'filters'));
    }
}

