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

class ProductController extends Controller
{
    public function view_product()
    {

        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                $models = Models::orderByDesc('model_id')->get();
                $operators = Operators::orderByDesc('operator_id')->get();
                $catagory = catagory::orderby('id', 'desc')->get();
                $characteristics = Characteristics::all();

                return view('admin.product', compact(['catagory', 'models', 'operators', 'characteristics']));

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }


    public function add_product(Request $request)
    {

        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $product = new product;
            
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

                $imagename = time() . '.' . $image->getClientOriginalExtension();

                $request->image->move('product', $imagename);

                $product->image = $imagename;

                $product->save();

                    // Guardar características del teléfono en la tabla 'phones_characteristics'
                    foreach ($request->input('characteristics') as $characteristic_id => $characteristic_value) {
                      
                        $product->phoneCharacteristics()->create([
                            'characteristic_id' => $characteristic_id,
                            'characteristic_value' => $characteristic_value,
                        ]);
                    }


                return redirect()->back()->with('message', 'Product Added Successfullly');
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }


    public function show_product()
    {

        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $product = Product::with(['model', 'phoneCharacteristics.characteristic'])->orderby('id', 'desc')->get();
                return view('admin.show_product', compact('product'));
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }


    public function delete_product($id)
    {

        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {

                $product = product::find($id);



                $product->delete();

                return redirect()->back()->with('message', 'Product Deleted Successfully');
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }


    public function update_product($id)
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;
    
            if ($usertype == '1') {
                $product = Product::with('phoneCharacteristics.characteristic')->find($id);
    
                $catagory = Catagory::all();
                $models = Models::with('brand')->get();
                $operators = Operators::all();
                $characteristics = Characteristics::all();
    
                return view('admin.update_product', compact('product', 'catagory', 'models', 'operators', 'characteristics'));
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }

    public function update_product_confirm(Request $request, $id)
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;
    
            if ($usertype == '1') {
                $product = Product::find($id);
    
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
                    $imagename = time() . '.' . $image->getClientOriginalExtension();
    
                    $request->image->move('product', $imagename);
    
                    $product->image = $imagename;
                }
    
                $product->save();
    
                // Actualizar características del teléfono en la tabla 'phones_characteristics'
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
    
                return redirect()->back()->with('message', 'Product Updated Successfully');
            }
        } else {
            return redirect('login');
        }
    }




/*     public function getFilters()
{
    $filters = Filters::all();
    return response()->json($filters);
} */
    

public function search_product(Request $request)
{
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
  

    // Si se proporcionaron ID de filtros, utilícelos para obtener los filtros correspondientes.
    // Si no, busque el filtro por la palabra clave ingresada.
    if ($filter_ids) {
        $selected_filters = Filters::whereIn('filter_id', $filter_ids)->get();
    } else {
        // Busca los filtros que coincidan con la palabra clave ingresada
        $found_filter = Filters::where('filter_name', 'LIKE', '%' . $search_text . '%')->first();

        // Asegúrate de que $selected_filters sea una colección, incluso si solo contiene un elemento
        $selected_filters = $found_filter ? collect([$found_filter]) : collect([]);
    }

    if (count($selected_filters) > 0) {
        // Inicializa la consulta base
        $query = Product::query();

        // Aplica cada criterio de las características asociadas a los filtros encontrados
        foreach ($selected_filters as $filter) {
            $filter->load('characteristics');
            foreach ($filter->characteristics as $characteristic) {
                $query->whereHas('characteristics', function ($q) use ($characteristic) {
                    $q->where('characteristics.characteristics_id', $characteristic->pivot->characteristic_id)
                      ->whereBetween(DB::raw('CAST(phones_characteristics.characteristic_value AS DECIMAL(10,2))'), [$characteristic->pivot->min_value, $characteristic->pivot->max_value]);
                });
            }

            // Aplica el criterio de precio si está presente en la relación de filtro-producto
            if ($filter->min_price !== null && $filter->max_price !== null) {
                $query->whereBetween('price', [$filter->min_price, $filter->max_price]);
            }
        }

        $product = $query->paginate(10);
    } else {
        // Si no se encuentra ningún filtro que coincida, realiza la búsqueda existente
        $product = Product::whereHas('model', function ($query) use ($search_text) {
            $query->where('model_name', 'LIKE', "%$search_text%")->orWhereHas('brand', function ($query) use ($search_text) {
                $query->where('brand_name', 'LIKE', "%$search_text%");
            });
        })->paginate(10);
    }

    return view('home.all_product', compact('product', 'comment', 'reply', 'cart_count', 'filters'));
}

 


    
    public function product_search(Request $request)

    {
        
        if(Auth::id())
        {
            $user_id=Auth::user()->id;

            $cart_count=cart::where('user_id','=',$user_id)->count();

        $comment=comment::orderby('id','desc')->get();

        $reply=reply::all();

        $filters = Filters::all();

        $serach_text=$request->search;

        $product = Product::whereHas('model', function ($query) use ($serach_text) {
            $query->where('model_name', 'LIKE', "%$serach_text%")->orWhereHas('brand', function ($query) use ($serach_text) {
                $query->where('brand_name', 'LIKE', "%$serach_text%");
            });
        })->paginate(10);

        return view('home.userpage',compact('product','comment','reply','cart_count','filters'));



        }


        else
        {

        $filters = Filters::all();

        $comment=comment::orderby('id','desc')->get();

        $reply=reply::all();

        $serach_text=$request->search;

        $product = Product::whereHas('model', function ($query) use ($serach_text) {
            $query->where('model_name', 'LIKE', "%$serach_text%")->orWhereHas('brand', function ($query) use ($serach_text) {
                $query->where('brand_name', 'LIKE', "%$serach_text%");
            });
        })->paginate(10);

        return view('home.userpage',compact('product','comment','reply','filters'));
        }
        

    }

    public function product()
    {

        if(Auth::id())

        {

            $product=Product::with('model.brand')->paginate(9);

      $comment=comment::orderby('id','desc')->get();

        $reply=reply::all();

        $filters = Filters::all();

        $user_id=Auth::user()->id;

        $cart_count=cart::where('user_id','=',$user_id)->count();

        return view('home.all_product',compact('product','comment','reply','cart_count','filters'));


        }


        else


        {

            $filters = Filters::all();


            $product=Product::with('model.brand')->paginate(9);

      $comment=comment::orderby('id','desc')->get();

        $reply=reply::all();

        

        return view('home.all_product',compact('product','comment','reply','filters'));
        }
        
    }

}

